@extends('layouts.plantilla')

@section('contenido')
    <h1>Pensión</h1>
    <form method="POST" action="{{ route('pension.store') }}" class="frmMatricular">
        @csrf
        <div class="form-group col-md-6">
            <label for="Concepto">Concepto</label>
            <select class='form-control select w-50 @error('Concepto') is-invalid @enderror' id="Concepto" name="Concepto">
                <option value="">- Seleccione el Concepto -</option>
                <option value="Pension de Marzo" {{ old('Concepto') == 'Pension de Marzo' ? 'selected' : '' }}>Pensión de
                    Marzo</option>
                <option value="Pension de Abril" {{ old('Concepto') == 'Pension de Abril' ? 'selected' : '' }}>Pensión de
                    Abril</option>
                <option value="Pension de Mayo" {{ old('Concepto') == 'Pension de Mayo' ? 'selected' : '' }}>Pensión de Mayo
                </option>
                <option value="Pension de Junio" {{ old('Concepto') == 'Pension de Junio' ? 'selected' : '' }}>Pensión de
                    Junio</option>
                <option value="Pension de Julio" {{ old('Concepto') == 'Pension de Julio' ? 'selected' : '' }}>Pensión de
                    Julio</option>
                <option value="Pension de Agosto" {{ old('Concepto') == 'Pension de Agosto' ? 'selected' : '' }}>Pensión de
                    Agosto</option>
                <option value="Pension de Septiembre" {{ old('Concepto') == 'Pension de Septiembre' ? 'selected' : '' }}>
                    Pensión de Septiembre</option>
                <option value="Pension de Octubre" {{ old('Concepto') == 'Pension de Octubre' ? 'selected' : '' }}>Pensión
                    de Octubre</option>
                <option value="Pension de Noviembre" {{ old('Concepto') == 'Pension de Noviembre' ? 'selected' : '' }}>
                    Pensión de Noviembre</option>
                <option value="Pension de Diciembre" {{ old('Concepto') == 'Pension de Diciembre' ? 'selected' : '' }}>
                    Pensión de Diciembre</option>
            </select>
            @error('Concepto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="CodigoPeriodo">Periodo</label>
            <input type="text" class="form-control w-25" id="CodigoPeriodo" name="CodigoPeriodo"
                value="{{ $periodo->CodigoPeriodo }}" readonly>
        </div>

        <div class="form-group">
            <label for="FechaInicio">Fecha de Inicio</label>
            <input type="date" class="form-control w-25" id="FechaInicio" name="FechaInicio"
                value="{{ old('FechaInicio') }}">
        </div>

        <div class="form-group">
            <label for="FechaVencimiento">Fecha de Vencimiento</label>
            <input type="date" class="form-control w-25" id="FechaVencimiento" name="FechaVencimiento"
                value="{{ old('FechaVencimiento') }}">
        </div>

        <div class="form-group">
            <label for="Mora_dia">Mora por día</label>
            <input type="number" class="form-control w-25 @error('Mora_dia') is-invalid @enderror" data-smk-type="decimal"
                style="text-align:right" id="Mora_dia" name="Mora_dia" value="{{ old('Mora_dia', 2) }}">
            @error('Mora_dia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="Descuento">Descuento (%)</label>
            <input type="number" class="form-control w-25 @error('Descuento') is-invalid @enderror" data-smk-type="decimal"
                style="text-align:right" id="Descuento" name="Descuento" value="{{ old('Descuento', 20) }}">
            @error('Descuento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Registrar</button>
        <a href="{{ route('cancelar5') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </form>
@endsection

@section('script')
    <script>
        let selectConcepto = document.getElementById('Concepto');
        let fechaInicio = document.getElementById("FechaInicio");
        let FechaVencimiento = document.getElementById("FechaVencimiento");
        let valoresMeses = [{
                concepto: 'Pension de Marzo',
                valor: '03'
            },
            {
                concepto: 'Pension de Abril',
                valor: '04'
            },
            {
                concepto: 'Pension de Mayo',
                valor: '05'
            },
            {
                concepto: 'Pension de Junio',
                valor: '06'
            },
            {
                concepto: 'Pension de Julio',
                valor: '07'
            },
            {
                concepto: 'Pension de Agosto',
                valor: '08'
            },
            {
                concepto: 'Pension de Septiembre',
                valor: '09'
            },
            {
                concepto: 'Pension de Octubre',
                valor: '10'
            },
            {
                concepto: 'Pension de Noviembre',
                valor: '11'
            },
            {
                concepto: 'Pension de Diciembre',
                valor: '12'
            },
        ];

        function ActualizarFechas() {

            if (selectConcepto.value === '') {

                fechaInicio.setAttribute('readonly', 'readonly');
                fechaInicio.value = "";
                fechaInicio.removeAttribute('min');
                fechaInicio.removeAttribute('max');

                FechaVencimiento.setAttribute('readonly', 'readonly');
                FechaVencimiento.value = "";
                FechaVencimiento.removeAttribute('min');
                FechaVencimiento.removeAttribute('max');

            } else {
                fechaInicio.removeAttribute('readonly');
                FechaVencimiento.removeAttribute('readonly');
                var mesEncontrado = valoresMeses.find(function(objeto) {
                    return objeto['concepto'] === selectConcepto.value;
                });
                var nuevoMes = mesEncontrado.valor;
                var periodo = @json($periodo);
                var valorMinMin = periodo.CodigoPeriodo + '-' + nuevoMes + '-01';
                var valorMaxMin = periodo.CodigoPeriodo + '-' + nuevoMes + '-07';

                var valorMinMax = periodo.CodigoPeriodo + '-' + nuevoMes + '-20';
                var valorMaxMax = periodo.CodigoPeriodo + '-' + nuevoMes + '-29';

                console.log(valorMinMin);
                console.log(valorMaxMin);
                console.log(valorMinMax);
                console.log(valorMaxMax);

                fechaInicio.setAttribute("min", valorMinMin);
                fechaInicio.setAttribute("max", valorMaxMin);
                fechaInicio.value = valorMinMin;

                FechaVencimiento.setAttribute("min", valorMinMax);
                FechaVencimiento.setAttribute("max", valorMaxMax);
                FechaVencimiento.value = valorMinMax;
            }
        }

        document.addEventListener('DOMContentLoaded', ActualizarFechas);
        selectConcepto.addEventListener('change', ActualizarFechas);
    </script>
@endsection
