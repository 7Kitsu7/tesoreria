{{-- @extends('layouts.plantilla')
@section('contenido')
    <h1>Matricular Alumno</h1>
    <form method="POST" action="{{ route('matricula.store') }}" class="frmMatricular">
        @csrf
        <div class="form-group">
            <label for="CodigoMatricula">N° Matricula</label>
            <input type="text" class="form-control w-25" id="CodigoMatricula" name="CodigoMatricula"
                value="{{ $nuevoCodigo }}" readonly>
        </div>

        <div class="form-group">
            <label for="CodigoPeriodo">Periodo</label>
            <input type="text" class="form-control w-25" id="CodigoPeriodo" name="CodigoPeriodo"
                value="{{ $periodo->CodigoPeriodo }}" readonly>
        </div>

        <div class="form-group">
            <label for="FechaMatricula">Fecha de Matricula</label>
            <input type="date" class="form-control w-25" id="FechaMatricula" name="FechaMatricula"
                min="{{ $periodo->CodigoPeriodo }}-01-24" max="{{ $periodo->CodigoPeriodo }}-07-17"
                value="{{ $periodo->CodigoPeriodo }}-01-24">
        </div>
        <div class="form-group">
            <label for="CodigoAlumno">Alumno</label><br>
            <select class="form-control select2  selectpicker w-25 @error('CodigoAlumno') is-invalid @enderror"
                data-theme="dark" data-select2id="1" tabindex="1" ariahidden="true" id="CodigoAlumno" name="CodigoAlumno"
                data-livesearch="true">
                <option>- Seleccione el Alumno -</option>
                @foreach ($alumno as $itemalumno)
                    @php
                        $codigoAlumno = $itemalumno->CodigoAlumno . '_' . $itemalumno->Nombres . '_' . $itemalumno->Apellidos . '_' . $itemalumno->escala->CodigoEscala . '_' . $itemalumno->escala->DescripcionEscala;
                    @endphp
                    <option value="{{ $codigoAlumno }}" {{ old('CodigoAlumno') == $codigoAlumno ? 'selected' : '' }}>
                        {{ $itemalumno->Nombres }} {{ $itemalumno->Apellidos }}
                    </option>
                @endforeach
            </select>
            @error('CodigoAlumno')
                <span class="mt-3 invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="CodigoAlumno">CodigoAlumno</label>
            <input type="text" class="form-control w-25" id="Codigo_Alumno" name="Codigo_Alumno" readonly="readonly">
        </div>

        <div class="form-group">
            <label for="Nombres">Nombres del Alumno</label>
            <input type="text" class="form-control w-25" id="Nombres" name="Nombres" readonly="readonly">
        </div>

        <div class="form-group">
            <label for="Apellidos">Apellidos del Alumno</label>
            <input type="text" class="form-control w-25" id="Apellidos" name="Apellidos" readonly="readonly">
        </div>

        <div class="form-group">
            <label for="DescripcionEscala">Escala del Alumno</label>
            <input type="text" class="form-control w-25" id="DescripcionEscala" name="DescripcionEscala"
                readonly="readonly">
        </div>

        <div class="form-group col-md-6">
            <label for="Nivel">Nivel</label>
            <select class='form-control select w-50 @error('Nivel') is-invalid @enderror' id="Nivel" name="Nivel"
                onchange="cargarGrados()">
                <option selected>- Seleccione el Nivel -</option>
                <option value="Primaria" {{ old('Nivel') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ old('Nivel') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
            </select>
            @error('Nivel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
            <label for="Grado">Grado</label>
            <select class='form-control select w-50 @error('Grado') is-invalid @enderror' id="Grado" name="Grado">
                <option selected>- Seleccione el Grado -</option>
            </select>
            @error('Grado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="Seccion">Seccion</label>
            <select class='form-control select w-50 @error('Seccion') is-invalid @enderror' id="Seccion" name="Seccion">
                <option selected>- Seleccione la Seccion -</option>
                <option value="A" {{ old('Seccion') == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('Seccion') == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('Seccion') == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('Seccion') == 'D' ? 'selected' : '' }}>D</option>
            </select>
            @error('Seccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="MontoMatricula">Monto a Pagar</label>
            <input type="text" class="form-control w-25" id="MontoMatricula" name="MontoMatricula" readonly="readonly">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Matricular</button>
        <a href="{{ route('cancelar4') }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
    </form>
@endsection
@section('script')
    <script>
        function cargarGrados() {
            const nivelSelect = document.getElementById("Nivel");
            const gradoSelect = document.getElementById("Grado");
            const oldGrado = '{{ old('Grado') }}';

            const gradosPrimaria = ["Primer Grado de Primaria", "Segundo Grado de Primaria", "Tercer Grado de Primaria",
                "Cuarto Grado de Primaria", "Quinto Grado de Primaria", "Sexto Grado de Primaria"
            ];
            const gradosSecundaria = ["Primer Grado de Secundaria", "Segundo Grado de Secundaria",
                "Tercer Grado de Secundaria", "Cuarto Grado de Secundaria", "Quinto Grado de Secundaria"
            ];

            gradoSelect.innerHTML = ""; // Limpiar el segundo select

            const nivelSeleccionado = nivelSelect.value;

            const opcion = document.createElement("option");
            opcion.value = "";
            opcion.text = "- Seleccione el Grado -";
            gradoSelect.appendChild(opcion);

            if (nivelSeleccionado === "Primaria") {

                for (let i = 1; i <= 6; i++) {
                    const opcion = document.createElement("option");
                    opcion.value = gradosPrimaria[i - 1];
                    opcion.text = gradosPrimaria[i - 1];
                    if (oldGrado == gradosPrimaria[i - 1]) {
                        opcion.selected = true;
                    }
                    gradoSelect.appendChild(opcion);
                }
            } else if (nivelSeleccionado === "Secundaria") {
                for (let i = 1; i <= 5; i++) {
                    const opcion = document.createElement("option");
                    opcion.value = gradosSecundaria[i - 1];
                    opcion.text = gradosSecundaria[i - 1];
                    if (oldGrado == gradosSecundaria[i - 1]) {
                        opcion.selected = true;
                    }
                    gradoSelect.appendChild(opcion);
                }
            }
        }

        function mostrardatosAlumno() {
            datosAlumno = document.getElementById('CodigoAlumno').value.split('_');
            $('#Codigo_Alumno').val(datosAlumno[0]);
            $('#Nombres').val(datosAlumno[1]);
            $('#Apellidos').val(datosAlumno[2]);
            codigoEscala = datosAlumno[3];
            escalas_periodos = @json($escalaPeriodo);
            var escEncontrada = escalas_periodos.find(function(objeto) {
                return objeto['CodigoEscala'] === codigoEscala;
            });
            $('#MontoMatricula').val(escEncontrada.MontoMatricula);
            $('#DescripcionEscala').val(datosAlumno[4]);
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#CodigoAlumno').change(function() {
                mostrardatosAlumno();
            });
            $('#CodigoAlumno').select2();

            cargarGrados();

            if (document.getElementById('CodigoAlumno').value.split('_').length != 1) {
                mostrardatosAlumno();
            }
        });
    </script>
@endsection --}}


@extends('layouts.plantilla')

@section('contenido')
    <h1>Matricular Alumno</h1>

    <form method="POST" action="{{ route('matricula.store') }}" class="frmMatricular">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="CodigoMatricula">N° Matricula</label>
                    <input type="text" class="form-control" id="CodigoMatricula" name="CodigoMatricula"
                        value="{{ $nuevoCodigo }}" readonly>
                </div>

                <div class="form-group">
                    <label for="CodigoPeriodo">Periodo</label>
                    <input type="text" class="form-control" id="CodigoPeriodo" name="CodigoPeriodo"
                        value="{{ $periodo->CodigoPeriodo }}" readonly>
                </div>

                <div class="form-group">
                    <label for="FechaMatricula">Fecha de Matricula</label>
                    <input type="date" class="form-control w-50" id="FechaMatricula" name="FechaMatricula"
                        min="{{ $periodo->CodigoPeriodo }}-01-24" max="{{ $periodo->CodigoPeriodo }}-07-17"
                        value="{{ $periodo->CodigoPeriodo }}-01-24">
                </div>

                <div class="form-group">
                    <label for="CodigoAlumno">Alumno</label><br>
                    <select class="form-control select2 selectpicker w-100 @error('CodigoAlumno') is-invalid @enderror"
                        data-theme="dark" data-select2id="1" tabindex="1" aria-hidden="true" id="CodigoAlumno"
                        name="CodigoAlumno" data-live-search="true">
                        <option>- Seleccione el Alumno -</option>
                        @foreach ($alumno as $itemalumno)
                            @php
                                $codigoAlumno = $itemalumno->CodigoAlumno . '_' . $itemalumno->Nombres . '_' . $itemalumno->Apellidos . '_' . $itemalumno->escala->CodigoEscala . '_' . $itemalumno->escala->DescripcionEscala;
                            @endphp
                            <option value="{{ $codigoAlumno }}"
                                {{ old('CodigoAlumno') == $codigoAlumno ? 'selected' : '' }}>
                                {{ $itemalumno->Nombres }} {{ $itemalumno->Apellidos }}
                            </option>
                        @endforeach
                    </select>
                    @error('CodigoAlumno')
                        <span class="mt-3 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="CodigoAlumno">CodigoAlumno</label>
                    <input type="text" class="form-control" id="Codigo_Alumno" name="Codigo_Alumno" readonly="readonly">
                </div>

                <div class="form-group">
                    <label for="Nombres">Nombres del Alumno</label>
                    <input type="text" class="form-control" id="Nombres" name="Nombres" readonly="readonly">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="Apellidos">Apellidos del Alumno</label>
                    <input type="text" class="form-control" id="Apellidos" name="Apellidos" readonly="readonly">
                </div>

                <div class="form-group">
                    <label for="DescripcionEscala">Escala del Alumno</label>
                    <input type="text" class="form-control" id="DescripcionEscala" name="DescripcionEscala"
                        readonly="readonly">
                </div>

                <div class="form-group col-md-6">
                    <label for="Nivel">Nivel</label>
                    <select class='form-control select w-100 @error('Nivel') is-invalid @enderror' id="Nivel"
                        name="Nivel" onchange="cargarGrados()">
                        <option selected>- Seleccione el Nivel -</option>
                        <option value="Primaria" {{ old('Nivel') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                        <option value="Secundaria" {{ old('Nivel') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                    </select>
                    @error('Nivel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="Grado">Grado</label>
                    <select class='form-control select w-100 @error('Grado') is-invalid @enderror' id="Grado"
                        name="Grado">
                        <option selected>- Seleccione el Grado -</option>
                    </select>
                    @error('Grado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="Seccion">Seccion</label>
                    <select class='form-control select w-100 @error('Seccion') is-invalid @enderror' id="Seccion"
                        name="Seccion">
                        <option selected>- Seleccione la Seccion -</option>
                        <option value="A" {{ old('Seccion') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('Seccion') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('Seccion') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('Seccion') == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('Seccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="MontoMatricula">Monto a Pagar</label>
                    <input type="text" class="form-control" id="MontoMatricula" name="MontoMatricula"
                        readonly="readonly">
                </div>
            </div>
        </div>

        <div class="form-group text-center mt-4">
            <button type="submit" class="btn btn-primary mr-4"><i class="fas fa-save"></i> Matricular</button>
            <a href="{{ route('cancelar4') }}" class="btn btn-danger ml-4"><i class="fas fa-ban"></i> Cancelar</a>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function cargarGrados() {
            const nivelSelect = document.getElementById("Nivel");
            const gradoSelect = document.getElementById("Grado");
            const oldGrado = '{{ old('Grado') }}';

            const gradosPrimaria = ["Primer Grado de Primaria", "Segundo Grado de Primaria", "Tercer Grado de Primaria",
                "Cuarto Grado de Primaria", "Quinto Grado de Primaria", "Sexto Grado de Primaria"
            ];
            const gradosSecundaria = ["Primer Grado de Secundaria", "Segundo Grado de Secundaria",
                "Tercer Grado de Secundaria", "Cuarto Grado de Secundaria", "Quinto Grado de Secundaria"
            ];

            gradoSelect.innerHTML = ""; // Limpiar el segundo select

            const nivelSeleccionado = nivelSelect.value;

            const opcion = document.createElement("option");
            opcion.value = "";
            opcion.text = "- Seleccione el Grado -";
            gradoSelect.appendChild(opcion);

            if (nivelSeleccionado === "Primaria") {

                for (let i = 1; i <= 6; i++) {
                    const opcion = document.createElement("option");
                    opcion.value = gradosPrimaria[i - 1];
                    opcion.text = gradosPrimaria[i - 1];
                    if (oldGrado == gradosPrimaria[i - 1]) {
                        opcion.selected = true;
                    }
                    gradoSelect.appendChild(opcion);
                }
            } else if (nivelSeleccionado === "Secundaria") {
                for (let i = 1; i <= 5; i++) {
                    const opcion = document.createElement("option");
                    opcion.value = gradosSecundaria[i - 1];
                    opcion.text = gradosSecundaria[i - 1];
                    if (oldGrado == gradosSecundaria[i - 1]) {
                        opcion.selected = true;
                    }
                    gradoSelect.appendChild(opcion);
                }
            }
        }

        function mostrardatosAlumno() {
            datosAlumno = document.getElementById('CodigoAlumno').value.split('_');
            $('#Codigo_Alumno').val(datosAlumno[0]);
            $('#Nombres').val(datosAlumno[1]);
            $('#Apellidos').val(datosAlumno[2]);
            codigoEscala = datosAlumno[3];
            escalas_periodos = @json($escalaPeriodo);
            var escEncontrada = escalas_periodos.find(function(objeto) {
                return objeto['CodigoEscala'] === codigoEscala;
            });
            $('#MontoMatricula').val(escEncontrada.MontoMatricula);
            $('#DescripcionEscala').val(datosAlumno[4]);
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#CodigoAlumno').change(function() {
                mostrardatosAlumno();
            });
            $('#CodigoAlumno').select2();

            cargarGrados();

            if (document.getElementById('CodigoAlumno').value.split('_').length != 1) {
                mostrardatosAlumno();
            }
        });
    </script>
@endsection
