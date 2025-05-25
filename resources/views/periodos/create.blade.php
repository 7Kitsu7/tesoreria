@extends('layouts.plantilla')
@section('contenido')
    <div class="container">
        <h1>Registrar Nuevo Periodo Academico</h1>
        <form method="POST" action="{{ route('periodo.store') }}">
            @csrf
            <div class="form-group">
                <label for="CodigoPeriodo">Año Periodo</label>
                <input type="text" class="form-control w-25" id="CodigoPeriodo" name="CodigoPeriodo"
                    value="{{ $sgtePeriodo }}" readonly>
            </div>

            <div class="form-group">
                <label for="FechaInicio">Fecha de Inicio</label>
                <input type="date" class="form-control w-25" id="FechaInicio" name="FechaInicio"
                    min="{{ $sgtePeriodo }}-03-01" max="{{ $sgtePeriodo }}-03-20" value="{{ $sgtePeriodo }}-03-01">
            </div>

            <div class="form-group">
                <label for="FechaTermino">Fecha de Termino</label>
                <input type="date" class="form-control w-25" id="FechaTermino" name="FechaTermino"
                    min="{{ $sgtePeriodo }}-12-10" max="{{ $sgtePeriodo }}-12-25" value="{{ $sgtePeriodo }}-12-10">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
            <a href="{{ route('cancelar') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</button></a>
        </form>
    </div>
@endsection
