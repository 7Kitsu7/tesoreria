@extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1 class="my-3">Pagos Realizados</h1>

    <div class="d-flex justify-content-center pb-4">
        <a href="{{ route('pago.create') }}" class="btn btn-primary bg-primary rounded-pill"><i
                class="fas fa-plus mr-2"></i>Registrar pago</a>
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

<table class="table table-responsive-lg">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N° Pago</th>
            <th scope="col">Nombres del Alumno</th>
            <th scope="col">Apellidos del Alumno</th>
            <th scope="col">Escala del Alumno</th>
            <th scope="col">Nombre del Apoderado</th>
            <th scope="col">Fecha de Pago</th>
            <th scope="col">Monto Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pago as $itempago)
            <tr>
                <td>{{ $itempago->NroPago }}</td>
                <td>{{ $itempago->matricula->alumno->Nombres }}</td>
                <td>{{ $itempago->matricula->alumno->Apellidos }}</td>
                <td>{{ $itempago->matricula->alumno->escala->DescripcionEscala}}</td>
                <td>{{ $itempago->matricula->alumno->NombreApoderado }}</td>
                <td>{{ Carbon::parse($itempago->FechaPago)->format('d-m-Y') }}</td>
                <td>{{ $itempago->Total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
