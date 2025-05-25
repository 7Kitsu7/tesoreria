{{-- @extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1 class="my-3">Matriculas Realizadas</h1>

    <div class="d-flex justify-content-center pb-4">
        <a href="{{ route('matricula.create') }}" class="btn btn-primary bg-primary rounded-pill"><i
                class="fas fa-plus mr-2"></i>Matricular alumno</a>
    </div>

    <p class="text-center" style="font-size: 20px"><i>Se pueden realizar matriculas desde el 24 de enero con plazo máximo
            hasta el 17 de
            julio del año {{ $codigoPeriodo }}</i></p>

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
            <th scope="col">N° Matricula</th>
            <th scope="col">Fecha Matricula</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Escala</th>
            <th scope="col">Nivel</th>
            <th scope="col">Grado</th>
            <th scope="col">Seccion</th>
            <th scope="col">Monto Pagado</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($matricula as $itemmatricula)
            <tr>
                <td>{{ $itemmatricula->CodigoMatricula }}</td>
                <td>{{ Carbon::parse($itemmatricula->FechaMatricula)->format('d-m-Y') }}</td>
                <td>{{ $itemmatricula->alumno->Nombres }}</td>
                <td>{{ $itemmatricula->alumno->Apellidos }}</td>
                <td>{{ $itemmatricula->alumno->escala->DescripcionEscala }}</td>
                <td>{{ $itemmatricula->Nivel }}</td>
                <td>{{ $itemmatricula->Grado }}</td>
                <td>{{ $itemmatricula->Seccion }}</td>
                <td>{{ $itemmatricula->MontoMatricula }}</td>
                <td><a href="{{ route('matricula.generarPDF', $itemmatricula->CodigoMatricula) }}" class="btn btn-success" target="_blank">PDF</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection --}}

@extends('layouts.plantilla')

@php
    use Carbon\Carbon;
@endphp

@section('contenido')
    <h1 class="my-3">Matriculas Realizadas</h1>

    <div class="d-flex justify-content-center pb-4">
        <a href="{{ route('matricula.create') }}" class="btn btn-primary bg-primary rounded-pill"><i
                class="fas fa-plus mr-2"></i>Matricular alumno</a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET" action="{{ route('matricula.index') }}">
                <label for="escala">Filtrar por Escala:</label>
                <select class="form-control" id="escala" name="escala" onchange="this.form.submit()">
                    <option value="" {{ request('escala') == '' ? 'selected' : '' }}>Todos</option>
                    <option value="Alta" {{ request('escala') == 'Alta' ? 'selected' : '' }}>Alta</option>
                    <option value="Media" {{ request('escala') == 'Media' ? 'selected' : '' }}>Media</option>
                    <option value="Baja" {{ request('escala') == 'Baja' ? 'selected' : '' }}>Baja</option>
                </select>
            </form>
        </div>
        <div class="col-md-6">
            <form method="GET" action="{{ route('matricula.index') }}">
                <label for="nivel">Filtrar por Nivel:</label>
                <select class="form-control" id="nivel" name="nivel" onchange="this.form.submit()">
                    <option value="" {{ request('nivel') == '' ? 'selected' : '' }}>Todos</option>
                    <option value="Primaria" {{ request('nivel') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                    <option value="Secundaria" {{ request('nivel') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                </select>
            </form>
        </div>
    </div>

    <p class="text-center" style="font-size: 20px"><i>Se pueden realizar matriculas desde el 24 de enero con plazo máximo
            hasta el 17 de julio del año {{ $codigoPeriodo }}</i></p>

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
            <th scope="col">N° Matricula</th>
            <th scope="col">Fecha Matricula</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Escala</th>
            <th scope="col">Nivel</th>
            <th scope="col">Grado</th>
            <th scope="col">Seccion</th>
            <th scope="col">Monto Pagado</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($matricula as $itemmatricula)
            @if (
                (request()->input('escala') === null ||
                    $itemmatricula->alumno->escala->DescripcionEscala === request()->input('escala')) &&
                    (request()->input('nivel') === null || $itemmatricula->Nivel === request()->input('nivel')))
                <tr>
                    <td>{{ $itemmatricula->CodigoMatricula }}</td>
                    <td>{{ Carbon::parse($itemmatricula->FechaMatricula)->format('d-m-Y') }}</td>
                    <td>{{ $itemmatricula->alumno->Nombres }}</td>
                    <td>{{ $itemmatricula->alumno->Apellidos }}</td>
                    <td>{{ $itemmatricula->alumno->escala->DescripcionEscala }}</td>
                    <td>{{ $itemmatricula->Nivel }}</td>
                    <td>{{ $itemmatricula->Grado }}</td>
                    <td>{{ $itemmatricula->Seccion }}</td>
                    <td>{{ $itemmatricula->MontoMatricula }}</td>
                    <td><a href="{{ route('matricula.generarPDF', $itemmatricula->CodigoMatricula) }}"
                            class="btn btn-success" target="_blank">PDF</a></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection
