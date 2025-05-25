<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabeceraPago;
use App\Models\Matricula;
use App\Models\Pension;
use App\Models\Periodo;
use App\Models\PensionMatricula;
use App\Models\DetallePago;
use Illuminate\Support\Facades\DB;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    const PAGINATION = 10;
    public function index()
    {
        $pago = CabeceraPago::where('estado', '=', '1')->paginate($this::PAGINATION);
        return view('pagos.index', compact('pago'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodoActivo = Periodo::where('Estado', '=', '1')->firstOrFail();
        $codigoPeriodo = $periodoActivo->CodigoPeriodo;
        $matricula = Matricula::join('periodo', 'matricula.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        $pension = Pension::join('periodo', 'pension.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        $pension_matricula = PensionMatricula::join('periodo', 'pension_matricula.CodigoPeriodo', '=', 'periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->where('pension_matricula.Estado', '=', '0')->get();

        $ultimoCodigo = CabeceraPago::max('NroPago');
        $ultimoNumero = intval(substr($ultimoCodigo, -1)); // Obtener el último número de la matrícula

        $nuevoNumero = $ultimoNumero + 1;
        $nuevoCodigo = str_pad($nuevoNumero, 8, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda si es necesario

        return view('pagos.create', compact('matricula', 'pension', 'pension_matricula', 'codigoPeriodo', 'nuevoCodigo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            /* Grabar Cabecera */
            /* Obtiene CodigoMatricula del alumno */
            $matricula = Matricula::where('CodigoMatricula', '=', $request->Codigo_Matricula)->firstOrFail();
            $pago = new CabeceraPago();
            $pago->NroPago = $request->NroPago;
            $pago->CodigoMatricula = $matricula->CodigoMatricula;
            $pago->FechaPago = $request->FechaPago;
            $pago->Estado = '1';
            $pago->Total = $request->total;
            $pago->save();
            /* Grabar Detalle */
            $cod_pension = $request->get('cod_pension');
            $montoPago = $request->get('montoPago');
            $mora = $request->get('mora');
            $descuento = $request->get('descuento');
            $cont = 0;
            while ($cont < count($cod_pension)) {
                $detalle = new DetallePago();
                $detalle->NroPago = $request->NroPago;
                $detalle->Concepto = $cod_pension[$cont];
                $detalle->CodigoPeriodo = $pago->matricula->CodigoPeriodo;
                $detalle->MontoPago = $montoPago[$cont];
                $detalle->Mora = $mora[$cont];
                $detalle->Descuento = $descuento[$cont];
                $detalle->save();
                $cont++;
            }
            DB::commit();

            return redirect()->route('pago.index');
        } catch (Exception $e) {
            DB::rollback();
        }
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
}
