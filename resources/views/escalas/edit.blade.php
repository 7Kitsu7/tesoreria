@extends('layouts.plantilla')
@section('contenido')
    <div class="container">
        <h1>Editar Monto a Pagar</h1>
        <form method="POST"
            action="{{ route('escala-periodo.update', [
                'CodigoPeriodo' => $escalaPeriodo->CodigoPeriodo,
                'CodigoEscala' => $escalaPeriodo->CodigoEscala,
            ]) }}">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="CodigoPeriodo">Periodo</label>
                <input type="text" class="form-control w-25" id="CodigoPeriodo" name="CodigoPeriodo"
                    value="{{ $escalaPeriodo->CodigoPeriodo }}" readonly>
            </div>

            <div class="form-group">
                <label for="CodigoEscala">Código Escala</label>
                <input type="text" class="form-control w-25" id="CodigoEscala" name="CodigoEscala"
                    value="{{ $escalaPeriodo->escala->CodigoEscala }}" readonly>
            </div>

            <div class="form-group">
                <label for="DescripcionEscala">Descripción Escala</label>
                <input type="text" class="form-control w-25" id="DescripcionEscala" name="DescripcionEscala"
                    value="{{ $escalaPeriodo->escala->DescripcionEscala }}" readonly>
            </div>

            <div class="form-group">
                <label for="MontoMatricula">Monto Matricula</label>
                <input type="number" class="form-control w-25 @error('MontoMatricula') is-invalid @enderror"
                    data-smk-type="decimal" style="text-align:right" id="MontoMatricula" name="MontoMatricula"
                    value="{{ $escalaPeriodo->MontoMatricula }}">
                @error('MontoMatricula')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="MontoPension">Monto Pension</label>
                <input type="number" class="form-control w-25 @error('MontoPension') is-invalid @enderror"
                    data-smk-type="decimal" style="text-align:right" id="MontoPension" name="MontoPension"
                    value="{{ $escalaPeriodo->MontoPension }}">
                @error('MontoPension')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
            <a href="{{ route('cancelar2') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
        </form>
    </div>
@endsection
