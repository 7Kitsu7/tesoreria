<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EscalaPeriodo;

class EscalaPeriodoController extends Controller
{
    public function edit($CodigoPeriodo, $CodigoEscala)
    {
        $escalaPeriodo = EscalaPeriodo::where('CodigoPeriodo', '=', $CodigoPeriodo)->where('CodigoEscala', '=', $CodigoEscala)->firstOrFail();
        return view('escalas.edit', compact('escalaPeriodo'));
    }

    public function update(Request $request, $CodigoPeriodo, $CodigoEscala)
    {
        $data = request()->validate(
            [
                'MontoMatricula' => 'required|numeric|min:200',
                'MontoPension' => 'required|numeric|min:70',
            ],
            [
                'MontoMatricula.required' => 'Ingrese el monto de matrícula que pagarán los alumnos pertenecientes a esta escala',
                'MontoMatricula.min' => 'El monto mínimo que se puede pagar en la matrícula es de 200 soles',
                'MontoPension.required' => 'Ingrese el monto de pensión que pagarán los alumnos pertenecientes a esta escala',
                'MontoPension.min' => 'El monto mínimo que se puede pagar en la pensión es de 70 soles',
            ]
        );

        $datosActualizar = [
            'MontoMatricula' => $request->MontoMatricula,
            'MontoPension' => $request->MontoPension,
        ];
        EscalaPeriodo::where('CodigoPeriodo', '=', $CodigoPeriodo)->where('CodigoEscala', '=', $CodigoEscala)->update($datosActualizar);
        return redirect()->route('escala.index')->with('datos', 'Montos Actualizados!');
    }
}
