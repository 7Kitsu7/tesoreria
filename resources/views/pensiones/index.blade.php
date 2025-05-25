@extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1 class="my-3">Pensiones Registradas</h1>

    <div class="d-flex justify-content-center pb-4">
        <a href="{{ route('pension.create') }}" class="btn btn-primary bg-primary rounded-pill"><i
                class="fas fa-plus mr-2"></i>Registrar Pensión</a>
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

    <table class="table table-responsive-mdp">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Concepto</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Fecha de Vencimiento</th>
            <th scope="col">Monto de mora por día</th>
            <th scope="col">Descuento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pension as $itempension)
            <tr>
                <td>{{ $itempension->Concepto }}</td>
                <td>{{ Carbon::parse($itempension->FechaInicio)->format('d-m-Y') }}</td>
                <td>{{ Carbon::parse($itempension->FechaVencimiento)->format('d-m-Y') }}</td>
                <td>{{ $itempension->Mora_dia}}</td>
                <td>{{ $itempension->Descuento }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection