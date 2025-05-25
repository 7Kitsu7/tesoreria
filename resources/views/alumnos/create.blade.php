{{-- @extends('layouts.plantilla')
@section('contenido')
    <div class="container">
        <h1 class="mb-3">Registrar Nuevo Alumno</h1>
        <form method="POST" action="{{ route('alumno.store') }}">
            @csrf
            <div class="form-group">
                <label for="CodigoAlumno">Codigo del Alumno</label>
                <input type="text" class="form-control w-25" name="CodigoAlumno" value="{{ $nuevoCodigo }}" readonly>
            </div>

            <div class="form-group">
                <label for="Nombres">Nombres</label>
                <input type="text" class="w-50 form-control @error('Nombres') is-invalid @enderror" id="Nombres"
                    name="Nombres" value="{{ old('Nombres') }}">
                @error('Nombres')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="Apellidos">Apellidos</label>
                <input type="text" class="w-50 form-control @error('Apellidos') is-invalid @enderror" id="Apellidos"
                    name="Apellidos" value="{{ old('Apellidos') }}">
                @error('Apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="Dni">Dni</label>
                <input type="text" class="w-25 form-control @error('Dni') is-invalid @enderror" id="Dni"
                    name="Dni" value="{{ old('Dni') }}">
                @error('Dni')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="Telefono">Telefono</label>
                <input type="text" class="w-25 form-control @error('Telefono') is-invalid @enderror" id="Telefono"
                    name="Telefono" value="{{ old('Telefono') }}">
                @error('Telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="FechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="w-25 form-control" id="FechaNacimiento" name="FechaNacimiento" min="2003-01-01"
                    max="2017-01-01" value="2003-01-01">
            </div>

            <div class="form-group">
                <label for="Direccion">Direccion</label>
                <input type="text" class="w-50 form-control @error('Direccion') is-invalid @enderror" id="Direccion"
                    name="Direccion" value="{{ old('Direccion') }}">
                @error('Direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="Sexo">Sexo</label>
                <select class='w-50 form-control select @error('Sexo') is-invalid @enderror' id="Sexo" name="Sexo">
                    <option selected>- Seleccione el Sexo -</option>
                    <option value="M" {{ old('Sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('Sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                </select>
                @error('Sexo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" class="w-50 form-control @error('Email') is-invalid @enderror" id="Email"
                    name="Email" value="{{ old('Email') }}">
                @error('Email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="CodigoEscala">Escala</label>
                <select class='w-50 form-control select @error('CodigoEscala') is-invalid @enderror' id="CodigoEscala"
                    name="CodigoEscala">
                    <option selected>- Seleccione la Escala -</option>
                    @foreach ($escala as $itemescala)
                        <option value="{{ $itemescala['CodigoEscala'] }}"
                            {{ old('CodigoEscala') == $itemescala->CodigoEscala ? 'selected' : '' }}>
                            {{ $itemescala['DescripcionEscala'] }}
                        </option>
                    @endforeach
                </select>
                @error('CodigoEscala')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="NombreApoderado">Apoderado</label>
                <input type="text" class="w-50 form-control @error('NombreApoderado') is-invalid @enderror"
                    id="NombreApoderado" name="NombreApoderado" value="{{ old('NombreApoderado') }}">
                @error('NombreApoderado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Grabar</button>
            <a href="{{ route('cancelar3') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const nombres = document.getElementById('Nombres');
        const apellidos = document.getElementById('Apellidos');
        const nombreApoderado = document.getElementById('NombreApoderado');
        const dni = document.getElementById('Dni');
        const telefono = document.getElementById('Telefono');

        function soloLetras(input) {
            input.addEventListener('keypress', function(e) {
                const key = e.key;
                const regex = /^[a-zA-Z\s]+$/;

                if (!regex.test(key)) {
                    e.preventDefault();
                }
            });
        }

        function soloNumeros(input) {
            input.addEventListener('input', function(e) {
                const value = e.target.value.trim();
                const sanitizedValue = value.replace(/^0+|[^0-9]/g, '');
                e.target.value = sanitizedValue;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            soloLetras(nombres);
            soloLetras(apellidos);
            soloLetras(nombreApoderado);
            soloNumeros(dni);
            soloNumeros(telefono);
        });
    </script>
@endsection --}}

@extends('layouts.plantilla')

@section('contenido')
    <div class="container">
        <h1 class="mb-3">Registrar Nuevo Alumno</h1>
        <form method="POST" action="{{ route('alumno.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="CodigoAlumno">Codigo del Alumno</label>
                        <input type="text" class="form-control w-75" name="CodigoAlumno" value="{{ $nuevoCodigo }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Nombres">Nombres</label>
                        <input type="text" class="w-75 form-control @error('Nombres') is-invalid @enderror" id="Nombres"
                            name="Nombres" value="{{ old('Nombres') }}">
                        @error('Nombres')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Apellidos">Apellidos</label>
                        <input type="text" class="w-75 form-control @error('Apellidos') is-invalid @enderror" id="Apellidos"
                            name="Apellidos" value="{{ old('Apellidos') }}">
                        @error('Apellidos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Dni">Dni</label>
                        <input type="text" class="w-50 form-control @error('Dni') is-invalid @enderror" id="Dni"
                            name="Dni" value="{{ old('Dni') }}">
                        @error('Dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Telefono">Telefono</label>
                        <input type="text" class="w-50 form-control @error('Telefono') is-invalid @enderror" id="Telefono"
                            name="Telefono" value="{{ old('Telefono') }}">
                        @error('Telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="FechaNacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="w-50 form-control" id="FechaNacimiento" name="FechaNacimiento" min="2003-01-01"
                            max="2017-01-01" value="2003-01-01">
                    </div>

                    <div class="form-group">
                        <label for="Direccion">Direccion</label>
                        <input type="text" class="w-75 form-control @error('Direccion') is-invalid @enderror" id="Direccion"
                            name="Direccion" value="{{ old('Direccion') }}">
                        @error('Direccion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Sexo">Sexo</label>
                        <select class='w-75 form-control select @error('Sexo') is-invalid @enderror' id="Sexo" name="Sexo">
                            <option selected>- Seleccione el Sexo -</option>
                            <option value="M" {{ old('Sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('Sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('Sexo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="w-75 form-control @error('Email') is-invalid @enderror" id="Email"
                            name="Email" value="{{ old('Email') }}">
                        @error('Email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="CodigoEscala">Escala</label>
                        <select class='w-75 form-control select @error('CodigoEscala') is-invalid @enderror' id="CodigoEscala"
                            name="CodigoEscala">
                            <option selected>- Seleccione la Escala -</option>
                            @foreach ($escala as $itemescala)
                                <option value="{{ $itemescala['CodigoEscala'] }}"
                                    {{ old('CodigoEscala') == $itemescala->CodigoEscala ? 'selected' : '' }}>
                                    {{ $itemescala['DescripcionEscala'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('CodigoEscala')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="NombreApoderado">Apoderado</label>
                        <input type="text" class="w-50 form-control @error('NombreApoderado') is-invalid @enderror"
                            id="NombreApoderado" name="NombreApoderado" value="{{ old('NombreApoderado') }}">
                        @error('NombreApoderado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-save"></i> Grabar</button>
                    <a href="{{ route('cancelar3') }}" class="btn btn-danger mx-2"><i class="fas fa-ban"></i> Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        const nombres = document.getElementById('Nombres');
        const apellidos = document.getElementById('Apellidos');
        const nombreApoderado = document.getElementById('NombreApoderado');
        const dni = document.getElementById('Dni');
        const telefono = document.getElementById('Telefono');

        function soloLetras(input) {
            input.addEventListener('keypress', function(e) {
                const key = e.key;
                const regex = /^[a-zA-Z\s]+$/;

                if (!regex.test(key)) {
                    e.preventDefault();
                }
            });
        }

        function soloNumeros(input) {
            input.addEventListener('input', function(e) {
                const value = e.target.value.trim();
                const sanitizedValue = value.replace(/^0+|[^0-9]/g, '');
                e.target.value = sanitizedValue;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            soloLetras(nombres);
            soloLetras(apellidos);
            soloLetras(nombreApoderado);
            soloNumeros(dni);
            soloNumeros(telefono);
        });
    </script>
@endsection


