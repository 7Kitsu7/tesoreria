<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Escala;
use App\Models\EscalaPeriodo;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periodo = Periodo::all();
        return view('periodos.index', compact('periodo'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ultimoNumero = Periodo::max('CodigoPeriodo');
        $numeroInicial = 2023;
        $sgtePeriodo = $ultimoNumero ? $ultimoNumero + 1 : $numeroInicial;
        return view('periodos.create', compact('sgtePeriodo'));
    }
    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periodo = new Periodo();
        $periodo->CodigoPeriodo = $request->CodigoPeriodo;
        $periodo->FechaInicio = $request->FechaInicio;
        $periodo->FechaTermino = $request->FechaTermino;
        $periodo->Estado = '0';
        $periodo->save();

        $escala = Escala::all();

        foreach ($escala as $itemescala) {
            $escalaPeriodo = new EscalaPeriodo();
            $escalaPeriodo->CodigoPeriodo = $request->CodigoPeriodo;
            $escalaPeriodo->CodigoEscala = $itemescala->CodigoEscala;
            $escalaPeriodo->MontoMatricula = '0';
            $escalaPeriodo->MontoPension = '0';
            try {
                $escalaPeriodo->save();
            } catch (\Illuminate\Database\QueryException $e) {
                continue;
            }
        }

        return redirect()->route('periodo.index')->with('datos', 'Nuevo Periodo Guardado...!');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function actualizarEstado(Request $request)
    {
        $codigoPeriodoSeleccionado = $request->Estado;

        // Actualizar el estado del periodo seleccionado a 1
        Periodo::where('CodigoPeriodo', '=', $codigoPeriodoSeleccionado)->update(['Estado' => 1]);

        // Actualizar el estado de los demás periodos a 0
        Periodo::where('CodigoPeriodo', '<>', $codigoPeriodoSeleccionado)->update(['Estado' => 0]);

        return redirect()->route('periodo.index')->with('datos', 'Nuevo Periodo Activo Seleccionado...');
    }
}
