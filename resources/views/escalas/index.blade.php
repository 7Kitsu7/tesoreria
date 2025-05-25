@extends('layouts.plantilla')

@section('contenido')
    @if (session('datos'))
        <div id="mensaje">
            @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
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

<h1 class="my-3">Escalas y Montos a Pagar </h1>

<p class="text-center" style="font-size: 20px"><i>Las escalas están predefinidas por el sistema de Tesorería y son
        las siguientes:</i></p>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Código Escala</th>
            <th scope="col">Descripcion Escala</th>
            <th scope="col">Monto Matricula</th>
            <th scope="col">Monto Pensión</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($escalaPeriodo as $itemescalaPeriodo)
            <tr>
                <td>{{ $itemescalaPeriodo->escala->CodigoEscala }}</td>
                <td>{{ $itemescalaPeriodo->escala->DescripcionEscala }}</td>
                <td>{{ $itemescalaPeriodo->MontoMatricula }}</td>
                <td>{{ $itemescalaPeriodo->MontoPension }}</td>
                <td> <a href="{{ route('escala-periodo.edit', [
                    'CodigoPeriodo' => $itemescalaPeriodo->CodigoPeriodo,
                    'CodigoEscala' => $itemescalaPeriodo->escala->CodigoEscala,
                ]) }}"
                        class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-edit mr-2"></i>Editar
                        Montos</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
