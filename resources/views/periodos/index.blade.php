@extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1>Periodos Academicos</h1>

    <div class="d-flex align-items-center justify-content-around py-2">

        <div>
            <a href="{{ route('periodo.create') }}" class="btn btn-primary bg-primary rounded-pill"><i class="fas fa-plus"></i>
                Registrar Periodo</a>
        </div>

        <div>
            <form class="d-flex align-items-center" method="POST" action="{{ route('periodo.actualizarEstado') }}">
                @csrf
                <label for="CódigoPeriodo" class="text-center">Escoja el Periodo del Sistema</label>
                <select class="form-control select w-25" name="Estado" id="Estado">
                    @foreach ($periodo as $itemperiodo)
                        <option value="{{ $itemperiodo->CodigoPeriodo }}"
                            {{ $itemperiodo->Estado == '1' ? 'selected' : '' }}>{{ $itemperiodo->CodigoPeriodo }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-success rounded-pill my-2 mx-3" type="submit">Seleccionar</button>
            </form>
        </div>
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

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Año Periodo</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Fecha de Termino</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($periodo as $itemperiodo)
            <tr>
                <td>{{ $itemperiodo->CodigoPeriodo }}</td>
                <td>{{ Carbon::parse($itemperiodo->FechaInicio)->format('d-m-Y') }}</td>
                <td>{{ Carbon::parse($itemperiodo->FechaTermino)->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
