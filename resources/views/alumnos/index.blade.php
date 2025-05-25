@extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1 class="my-3">Alumnos Registrados</h1>

    <div class="d-flex justify-content-center pb-4">
        <a href="{{ route('alumno.create') }}" class="btn btn-primary bg-primary rounded-pill"><i
                class="fas fa-plus mr-2"></i>Registrar Alumno</a>
    </div>

    @if (session('datos'))
        <div id="mensaje">
            @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt3" role="alert">
                    {{ session('datos') }}
                    <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    @endif

@section('script')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 2000);
    </script>
@endsection

<table class="table table-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">DNI</th>
            <th scope="col">Telefono</th>
            <th scope="col">F. Nacimiento</th>
            <th scope="col">Direccion</th>
            <th scope="col">Sexo</th>
            <th scope="col">Email</th>
            <th scope="col">Escala</th>
            <th scope="col">Apoderado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alumno as $itemalumno)
            <tr>
                <td>{{ $itemalumno->CodigoAlumno }}</td>
                <td>{{ $itemalumno->Nombres }}</td>
                <td>{{ $itemalumno->Apellidos }}</td>
                <td>{{ $itemalumno->Dni }}</td>
                <td>{{ $itemalumno->Telefono }}</td>
                <td>{{ Carbon::parse($itemalumno->FechaNacimiento)->format('d-m-Y') }}</td>
                <td>{{ $itemalumno->Direccion }}</td>
                <td>{{ $itemalumno->Sexo }}</td>
                <td>{{ $itemalumno->Email }}</td>
                <td>{{ $itemalumno->escala->CodigoEscala }}</td>
                <td>{{ $itemalumno->NombreApoderado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
