<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Alumno;
use App\Models\Periodo;
use App\Models\EscalaPeriodo;
use Barryvdh\DomPDF\Facade\Pdf;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodoActivo = Periodo::where('Estado', '=', '1')->firstOrFail();
        $codigoPeriodo = $periodoActivo->CodigoPeriodo;
        $matricula = Matricula::join('periodo', 'matricula.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        return view('matriculas.index', compact('matricula', 'codigoPeriodo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodo = Periodo::where('Estado', '=', '1')->firstOrFail();

        $codigo = $periodo->CodigoPeriodo;

        $escalaPeriodo = EscalaPeriodo::where('CodigoPeriodo', '=', $codigo)->get();

        $alumno = Alumno::whereDoesntHave('matriculas', function ($query) use ($codigo) {
            $query->where('CodigoPeriodo', $codigo);
        })->get();

        $ultimoCodigo = Matricula::max('CodigoMatricula');
        $ultimoNumero = intval(substr($ultimoCodigo, -1)); // Obtener el último número de la matrícula

        $nuevoNumero = $ultimoNumero + 1;
        $nuevoCodigo = str_pad($nuevoNumero, 10, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda si es necesario

        return view('matriculas.create', compact('alumno', 'periodo', 'escalaPeriodo', 'nuevoCodigo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'CodigoAlumno' => ['required', function ($attribute, $value, $fail) {
                if ($value === "- Seleccione el Alumno -") {
                    $fail('Seleccione un alumno válido');
                }
            }],
            'Nivel' => ['required', function ($attribute, $value, $fail) {
                if ($value === "- Seleccione el Nivel -") {
                    $fail('Seleccione un nivel válido');
                }
            }],
            'Grado' => ['required', function ($attribute, $value, $fail) {
                if ($value === "- Seleccione el Grado -") {
                    $fail('Seleccione un grado válido');
                }
            }],
            'Seccion' => ['required', function ($attribute, $value, $fail) {
                if ($value === "- Seleccione la Seccion -") {
                    $fail('Seleccione una sección válida');
                }
            }],
        ], [
            'CodigoAlumno.required' => 'Seleccione un alumno válido',
            'Nivel.required' => 'Seleccione un nivel válido',
            'Grado.required' => 'Seleccione un grado válido',
            'Seccion.required' => 'Seleccione una sección vália'
        ]);

        $matricula = new Matricula();
        $matricula->CodigoMatricula = $request->CodigoMatricula;
        $matricula->CodigoAlumno = $request->Codigo_Alumno;
        $matricula->CodigoPeriodo = $request->CodigoPeriodo;
        $matricula->FechaMatricula = $request->FechaMatricula;
        $matricula->Nivel = $request->Nivel;
        $matricula->Grado = $request->Grado;
        $matricula->Seccion = $request->Seccion;
        $matricula->MontoMatricula = $request->MontoMatricula;
        $matricula->Estado = '1';
        $matricula->save();

        return view('matriculas.confirmPDF')->with([
            'message' => '¿Desea generar un PDF?',
            'pdfUrl' => route('matricula.generarPDF', $request->CodigoMatricula),
            'indexUrl' => route('matricula.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generarPDF($CodigoMatricula)
    {
        $matricula = Matricula::findOrFail($CodigoMatricula);
        $pdf = PDF::loadView('matriculas.pdf', compact('matricula'));
        return $pdf->stream('matricula_N°' . $CodigoMatricula . '.pdf');
    }
}
