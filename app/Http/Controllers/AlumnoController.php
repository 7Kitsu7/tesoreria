<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Escala;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumno = Alumno::all();
        return view('alumnos.index', compact('alumno'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $escala = Escala::all();

        $ultimoCodigo = Alumno::max('CodigoAlumno');
        $ultimoNumero = intval(substr($ultimoCodigo, -4)); // Obtener los últimos 4 dígitos del código de alumno

        $nuevoNumero = $ultimoNumero + 1;
        $nuevoCodigo = 'AL' . str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda si es necesario
        return view('alumnos.create', compact('escala', 'nuevoCodigo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'Nombres' => 'required|max:60',
                'Apellidos' => 'required|max:60',
                'Dni' => 'required|min:8|max:8',
                'Telefono' => 'required|max:9',
                'Direccion' => 'required|max:60',
                'Sexo' => ['required', function ($attribute, $value, $fail) {
                    if ($value === "- Seleccione el Sexo -") {
                        $fail('Seleccione un sexo válido');
                    }
                }],
                'CodigoEscala' => ['required', function ($attribute, $value, $fail) {
                    if ($value === "- Seleccione la Escala -") {
                        $fail('Seleccione una escala válida');
                    }
                }],
                'Email' => ['required', 'email', 'max:60'],
                'NombreApoderado' => 'required|max:60',
            ],
            [
                'Nombres.required' => 'Ingrese su nombre por favor',
                'Nombres.max' => 'El número máximo de caracteres permitidos es de 60',
                'Apellidos.required' => 'Ingrese su apellido por favor',
                'Apellidos.max' => 'El número máximo de caracteres permitidos es de 60',
                'Dni.required' => 'Ingrese su DNI por favor',
                'Dni.max' => 'La cantidad de dígitos de un DNI es 8',
                'Dni.min' => 'La cantidad de dígitos de un DNI es 8',
                'Telefono.required' => 'Ingrese su número de teléfono por favor',
                'Telefono.max' => 'El número máximo de caracteres permitidos es de 9',
                'Direccion.required' => 'Ingrese su dirección por favor',
                'Direccion.max' => 'El número máximo de caracteres permitidos es de 60',
                'Sexo.required' => 'Seleccione un sexo válido',
                'CodigoEscala.required' => 'Seleccione una escala válida',
                'Email.required' => 'Ingrese su correo electrónico por favor',
                'Email.email' => 'El formato ingresado no corresponde a un correo valido',
                'Email.max' => 'El número máximo de caracteres permitidos es de 60',
                'NombreApoderado.required' => 'Ingrese el nombre del apoderado por favor',
                'NombreApoderado.max' => 'El número máximo de caracteres permitidos es de 60'
            ]
        );

        $alumno = new Alumno();
        $alumno->CodigoAlumno = $request->CodigoAlumno;
        $alumno->Nombres = $request->Nombres;
        $alumno->Apellidos = $request->Apellidos;
        $alumno->Dni = $request->Dni;
        $alumno->Telefono = $request->Telefono;
        $alumno->FechaNacimiento = $request->FechaNacimiento;
        $alumno->Direccion = $request->Direccion;
        $alumno->Sexo = $request->Sexo;
        $alumno->Email = $request->Email;
        $alumno->CodigoEscala = $request->CodigoEscala;
        $alumno->NombreApoderado = $request->NombreApoderado;
        $alumno->save();
        return redirect()->route('alumno.index')->with('datos', 'Nuevo Alumno Guardado...!');
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
