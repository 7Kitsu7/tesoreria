<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pension;
use App\Models\Periodo;
use App\Models\PensionMatricula;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\EscalaPeriodo;

class PensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pension = Pension::join('periodo', 'pension.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        return view('pensiones.index', compact('pension'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodo = Periodo::where('Estado', '=', '1')->firstOrFail();
        return view('pensiones.create', compact('periodo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'Concepto' => ['required', function ($attribute, $value, $fail) {
                    if ($value === "- Seleccione el Concepto -") {
                        $fail('Seleccione un concepto válido');
                    }
                }],
                'Mora_dia' => 'required|numeric|min:2|max:10',
                'Descuento' => 'required|numeric|min:20|max:35',

            ],
            [
                'Concepto.required' => 'Seleccione un concepto valido',
                'Mora_dia.required' => 'Ingrese el monto de la mora por dia',
                'Mora_dia.min' => 'El monto mínimo que se puede pagar en la mora por dia es de 2 soles',
                'Mora_dia.max' => 'El monto maximo que se puede pagar en la mora por dia es de 10 soles',
                'Descuento.required' => 'Ingrese el descuento de la pensión',
                'Descuento.min' => 'El porcentaje mínimo de descuento es del 20%',
                'Descuento.max' => 'El porcentaje maximo de descuento es del 35%',
            ]
        );
        $pension = new Pension();
        $pension->Concepto = $request->Concepto;
        $pension->CodigoPeriodo = $request->CodigoPeriodo;
        $pension->FechaInicio = $request->FechaInicio;
        $pension->FechaVencimiento = $request->FechaVencimiento;
        $pension->Mora_dia = $request->Mora_dia;
        $pension->Descuento = $request->Descuento;
        $pension->save();
        $concepto = $request->Concepto;
        $codperiodo = $request->CodigoPeriodo;
        $alumnosmatriculados = Matricula::join('periodo', 'matricula.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        foreach ($alumnosmatriculados as $itemalumnosmatriculados) {
            $pension_matricula = new PensionMatricula();
            $codalumno = $itemalumnosmatriculados->CodigoAlumno;
            $alumno = Alumno::findOrFail($codalumno);
            $codescala = $alumno->CodigoEscala;
            $escalaPeriodo = EscalaPeriodo::where('CodigoPeriodo', '=', $codperiodo)->where('CodigoEscala', '=', $codescala)->firstOrFail();
            $pension_matricula->Concepto = $request->Concepto;
            $pension_matricula->CodigoPeriodo = $request->CodigoPeriodo;
            $pension_matricula->CodigoMatricula = $itemalumnosmatriculados->CodigoMatricula;
            $pension_matricula->MontoPension = $escalaPeriodo->MontoPension;
            $pension_matricula->Estado = '0';
            $pension_matricula->save();
        }
        return redirect()->route('pension.index')->with('datos', 'Nueva Pension Guardada...!');
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
}
