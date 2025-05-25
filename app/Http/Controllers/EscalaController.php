<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escala;
use App\Models\EscalaPeriodo;

class EscalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $escalaPeriodo = EscalaPeriodo::join('periodo','escala_periodo.CodigoPeriodo','=','periodo.CodigoPeriodo')->where('periodo.Estado', '=', '1')->get();
        return view('escalas.index', compact('escalaPeriodo'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escalas.create');
    }
    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'CodigoEscala' => 'required|max:1',
                'DescripcionEscala' => 'required|max:6'
            ],
            [
                'CodigoEscala.required' => 'Ingrese el codigo con el que se identificará a la escala',
                'CodigoEscala.max' => 'El código de la escala debe tener solo 1 caracter',
                'DescripcionEscala.required' => 'Ingrese la descripcion de la escala',
                'DescripcionEscala.max' => 'La descripción de la escala debe tener máximo 6 caracteres',
            ]
        );
        $escala = new Escala();
        $escala->CodigoEscala = $request->CodigoEscala;
        $escala->DescripcionEscala = $request->DescripcionEscala;
        $escala->save();
        return redirect()->route('escala.index')->with('datos', 'Nueva Escala Guardada...!');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($CodigoEscala)
    {
        //
    }

    public function edit($CodigoEscala)
    {
        $escala = Escala::findOrFail($CodigoEscala);
        return view('escalas.edit', compact('escala'));
    }

    public function update(Request $request, $CodigoEscala)
    {
        $data = request()->validate(
            [
                'CodigoEscala' => 'required|max:1',
                'DescripcionEscala' => 'required|max:6'
            ],
            [
                'CodigoEscala.required' => 'Ingrese el codigo con el que se identificará a la escala',
                'CodigoEscala.max' => 'El código de la escala debe tener solo 1 caracter',
                'DescripcionEscala.required' => 'Ingrese la descripcion de la escala',
                'DescripcionEscala.max' => 'La descripción de la escala debe tener máximo 6 caracteres',
            ]
        );
        $escala = Escala::findOrFail($CodigoEscala);
        $escala->CodigoEscala = $request->CodigoEscala;
        $escala->DescripcionEscala = $request->DescripcionEscala;
        $escala->save();
        return redirect()->route('escala.index')->with('datos', 'Escala Actualizada...!');
    }
}
