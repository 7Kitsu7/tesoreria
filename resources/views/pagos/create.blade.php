{{-- @extends('layouts.plantilla')

@section('contenido')
    <h1>Registrar Pago</h1>
    <div class="alert hidden" role="alert"></div>
    <form method="POST" action="{{ route('pago.store') }}">
        @csrf
        <div class="form-group">
            <label for="NroPago">N° Pago</label>
            <input type="text" class="form-control w-25" name="NroPago" id="NroPago" value="{{ $nuevoCodigo }}" readonly>
        </div>

        <div class="form-group">
            <label for="FechaPago">Fecha de Pago</label>
            <input type="date" class="form-control w-25" id="FechaPago" name="FechaPago"
                min="{{ $codigoPeriodo . '-03-06' }}" max="{{ $codigoPeriodo . '-12-20' }}"
                value="{{ old('FechaPago', $codigoPeriodo . '-03-06') }}">
        </div>

        <div class="form-group">
            <label for="CodigoMatricula">Alumno</label>
            <br>
            <select class="form-control select2 selectpicker w-25" data-theme="dark" data-select2id="1" tabindex="1"
                ariahidden="true" id="CodigoMatricula" name="CodigoMatricula" data-live-search="true">
                <option value="0" selected>- Seleccione Alumno -</option>
                @foreach ($matricula as $itemmatricula)
                    <option
                        value="{{ $itemmatricula->CodigoMatricula }}_{{ $itemmatricula->alumno->escala->DescripcionEscala }}_{{ $itemmatricula->alumno->NombreApoderado }}">
                        {{ $itemmatricula->alumno->Nombres }} {{ $itemmatricula->alumno->Apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="Codigo_Matricula">N° Matricula</label>
            <input type="text" class="form-control w-25" name="Codigo_Matricula" id="Codigo_Matricula" readonly>
        </div>

        <div class="form-group">
            <label for="DescripcionEscala">Escala a la que pertenece</label>
            <input type="text" class="form-control w-25" name="DescripcionEscala" id="DescripcionEscala" readonly>
        </div>

        <div class="form-group">
            <label for="NombreApoderado">Nombres del Apoderado </label>
            <input type="text" class="form-control w-25" name="NombreApoderado" id="NombreApoderado" readonly>
        </div>

        <div class="form-group">
            <label for="Concepto">Concepto de Pensión </label>
            <select class="form-control select select2 select2-hiddenaccessible selectpicker w-25" style="width:100%;"
                data-select2-id="1" tabindex="-1" ariahidden="true" id="Concepto" name="Concepto" data-live-search="true">
                <option value="0" selected> - Seleccione Concepto - </option>
                @foreach ($pension as $itempension)
                    <option
                        value="{{ $itempension->Concepto }}_{{ $itempension->FechaInicio }}_{{ $itempension->FechaVencimiento }}_{{ $itempension->Mora_dia }}_{{ $itempension->Descuento }}">
                        {{ $itempension->Concepto }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Monto a Pagar</label>
            <input type="text" class="form-control w-25" name="MontoPago" id="MontoPago" readonly>
        </div>

        <div class="row pt-3">
            <div class="col-md-1">
                <label for="Descuento">Descuento</label>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="Descuento" id="Descuento" readonly>
            </div>
            <div class="col-md-1 ml-3">
                <label for="Mora" style="vertical-align: middle">Mora</label>
            </div>
            <div class="col-md-2">
                <input style="margin-left: -40px" type="text" class="form-control" name="Mora" id="Mora"
                    readonly>
            </div>
            <div class="col-md-3">
                <button type="button" id="btn-adddet" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                    Agregar al carrito</button>
            </div>
        </div>
        <div class="col-md-12 pt-3">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"
                    style='background-color:#FFFFFF;'>
                    <thead class="thead-default" style="background-color:#3c8dbc; color:#fff;">
                        <th class="text-center">CONCEPTO PAGO</th>
                        <th>MONTO DE PAGO</th>
                        <th class="text-center">DESCUENTO</th>
                        <th class="text-center">MORA</th>
                        <th>IMPORTE</th>
                        <th width="10" class="text-center">ELIMINAR</th>
                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                <label for="">Total:</label>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="total" id="total"
                    readonly="readonly">
            </div>
        </div>

        <div class="col-md-12 text-center">
            <div id="guardar">
                <div class="form-group">
                    <button class="btn btn-primary" id="btnRegistrar" type="submit"
                        data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando">
                        <i class='fas fa-save'></i> Registrar</button>
                    <a href="{{ URL::to('pago') }}" class='btn btn-danger'><i class='fas fa-ban'></i>Cancelar</a>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection


@section('script')
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="/archivos/js/createdoc.js"></script>

    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    </script>
    <script>
        var cont = 0;
        var total = 0;
        var detallepago = [];
        var subtotal = [];
        var subtotal2 = [];
        var controlpension = [];

        function mostrardatosAlumno() {
            datosAlumno = document.getElementById('CodigoMatricula').value.split('_');
            $('#Codigo_Matricula').val(datosAlumno[0]);
            $('#DescripcionEscala').val(datosAlumno[1]);
            $('#NombreApoderado').val(datosAlumno[2]);
        }

        function mostrarMonto() {
            pension_matriculas = @json($pension_matricula);
            var alumnoBuscado = pension_matriculas.find(function(objeto) {
                return objeto['CodigoMatricula'] === datosAlumno[0];
            });
            $('#MontoPago').val(alumnoBuscado.MontoPension);
        }


        function determinarMoraDescuento() {
            concepto = document.getElementById('Concepto').value.split('_');
            fechaPago = new Date(document.getElementById('FechaPago').value);
            FechaInicio = new Date(concepto[1]);
            FechaFin = new Date(concepto[2]);
            pctjDescuento = concepto[4] / 100;
            montoPago = document.getElementById('MontoPago').value;
            montoDescuento = pctjDescuento * montoPago;

            if (fechaPago >= FechaInicio && fechaPago <= FechaFin) {
                diasTranscurridos = Math.floor((fechaPago - FechaInicio) / (1000 * 60 * 60 * 24));
                if (diasTranscurridos <= 5) {
                    $('#Descuento').val(montoDescuento);
                } else {
                    $('#Descuento').val(0);
                }
                $('#Mora').val(0);
            } else if (fechaPago > FechaFin) {
                diasTranscurridos = Math.floor((fechaPago - FechaFin) / (1000 * 60 * 60 * 24));
                $('#Descuento').val(0);
                moraTotal = concepto[3] * diasTranscurridos;
                $('#Mora').val(moraTotal);
            }
        }

        /* Mostrar Mensajes de Error */
        function mostrarMensajeError(mensaje) {
            $(".alert").css('display', 'block');
            $(".alert").removeClass("hidden");
            $(".alert").addClass("alert-danger");
            $(".alert").html("<button type='button' class='close' dataclose='alert'>×</button>" + "<span><b>Error!</b> " +
                mensaje + ".</span>");
            $('.alert').delay(5000).hide(400);
        }

        function agregarDetalle() {
            concepto = $('#Concepto option:selected').text();
            if (concepto == '- Seleccione Concepto -') {
                mostrarMensajeError("Por favor seleccione el Concepto de Pago");
                return false;
            }
            let descuento = parseFloat($("#Descuento").val());
            let mora = parseFloat($("#Mora").val());
            let montoPago = parseFloat($("#MontoPago").val());;

            concepto = document.getElementById('Concepto').value.split('_');
            cod_pension = concepto[0];
            /* Buscar que codigo de producto no se repita */
            var i = 0;
            var band = false;
            while (i < cont) {
                if (controlpension[i] == cod_pension) {
                    band = true;
                }
                i = i + 1;
            }
            if (band == true) {
                mostrarMensajeError("No puede volver a seleccionar el mismo concepto");
                return false;
            } else {
                subtotal[cont] = montoPago - descuento + mora;
                controlpension[cont] = cod_pension;
                total = total + subtotal[cont];
                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td style="text-align:right;">' + '<input type="text" name="cod_pension[]" value="' + cod_pension +
                    '"style="width:180px; text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="montoPago[]" value="' + montoPago +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="descuento[]" value="' + descuento +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="mora[]" value="' + mora +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + number_format(subtotal[cont], 2) + '</td>' +
                    '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(\'' +
                    cod_pension + '\',' + cont + ');"><i class="fa fa-times"></i></button></td>' +
                    '</tr>';

                $('#detalles').append(fila);
                detallepago.push({
                    concepto: cod_pension,
                    montoPago: montoPago,
                    descuento: descuento,
                    mora: mora,
                    subtotal: subtotal
                });
                cont++;
            }
            $('#total').val(number_format(total, 2));
            limpiar();
        }

        function limpiar() {
            $("#Concepto").val("0").change();
            $("#MontoPago").val('');
            $("#Descuento").val('');
            $("#Mora").val('');
        }

        /* Eliminar conceptos */
        function eliminardetalle(concepto, index) {
            total = total - subtotal[index];
            tam = detallepago.length;
            var i = 0;
            var pos;
            while (i < tam) {
                if (detallepago[i].concepto == concepto) {
                    pos = i;
                    break;
                }
                i = i + 1;
            }
            detallepago.splice(pos, 1);
            $('#fila' + index).remove();
            controlpension[index] = "";
            $('#total').val(number_format(total, 2));
        }

        function number_format(amount, decimals) {
            amount += ''; // por si pasan un numero en vez de un string
            amount = parseFloat(amount.replace(/[^09\.] /g, '')); // elimino cualquier cosa que no sea numero o punto
            decimals = decimals || 0; // por si la variable no fue pasada
            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amount) || amount === 0)
                return parseFloat(0).toFixed(decimals);
            // si es mayor o menor que cero retorno el valor formateado como numero
            amount = '' + amount.toFixed(decimals);
            var amount_parts = amount.split('.'),
                regexp = /(\d+)(\d{3})/;
            while (regexp.test(amount_parts[0]))
                amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
            return amount_parts.join('.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#CodigoMatricula').change(function() {
                mostrardatosAlumno();
            });

            $('#FechaPago').on('change', function() {
                determinarMoraDescuento();
            });

            $('#Concepto').change(function() {
                mostrarMonto();
                determinarMoraDescuento();
            });

            $('#btn-adddet').click(function() {
                agregarDetalle();
            });

            $('#CodigoMatricula').select2();
        });
    </script>
@endsection --}}



@extends('layouts.plantilla')

@section('contenido')
    <h1>Registrar Pago</h1>
    <div class="alert hidden" role="alert"></div>
    <form method="POST" action="{{ route('pago.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="NroPago">N° Pago</label>
                    <input type="text" class="form-control w-75" name="NroPago" id="NroPago" value="{{ $nuevoCodigo }}" readonly>
                </div>

                <div class="form-group">
                    <label for="FechaPago">Fecha de Pago</label>
                    <input type="date" class="form-control w-75" id="FechaPago" name="FechaPago"
                        min="{{ $codigoPeriodo . '-03-06' }}" max="{{ $codigoPeriodo . '-12-20' }}"
                        value="{{ old('FechaPago', $codigoPeriodo . '-03-06') }}">
                </div>

                <div class="form-group">
                    <label for="CodigoMatricula">Alumno</label>
                    <br>
                    <select class="form-control select2 selectpicker w-75" data-theme="dark" data-select2id="1" tabindex="1"
                        ariahidden="true" id="CodigoMatricula" name="CodigoMatricula" data-live-search="true">
                        <option value="0" selected>- Seleccione Alumno -</option>
                        @foreach ($matricula as $itemmatricula)
                            <option
                                value="{{ $itemmatricula->CodigoMatricula }}_{{ $itemmatricula->alumno->escala->DescripcionEscala }}_{{ $itemmatricula->alumno->NombreApoderado }}">
                                {{ $itemmatricula->alumno->Nombres }} {{ $itemmatricula->alumno->Apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="Codigo_Matricula">N° Matricula</label>
                    <input type="text" class="form-control w-75" name="Codigo_Matricula" id="Codigo_Matricula" readonly>
                </div>

                <div class="form-group">
                    <label for="DescripcionEscala">Escala a la que pertenece</label>
                    <input type="text" class="form-control w-75" name="DescripcionEscala" id="DescripcionEscala" readonly>
                </div>

                <div class="form-group">
                    <label for="NombreApoderado">Nombres del Apoderado </label>
                    <input type="text" class="form-control w-75" name="NombreApoderado" id="NombreApoderado" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="Concepto">Concepto de Pensión </label>
                    <select class="form-control select select2 select2-hiddenaccessible selectpicker w-75" style="width:100%;"
                        data-select2-id="1" tabindex="-1" ariahidden="true" id="Concepto" name="Concepto" data-live-search="true">
                        <option value="0" selected> - Seleccione Concepto - </option>
                        @foreach ($pension as $itempension)
                            <option
                                value="{{ $itempension->Concepto }}_{{ $itempension->FechaInicio }}_{{ $itempension->FechaVencimiento }}_{{ $itempension->Mora_dia }}_{{ $itempension->Descuento }}">
                                {{ $itempension->Concepto }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Monto a Pagar</label>
                    <input type="text" class="form-control w-75" name="MontoPago" id="MontoPago" readonly>
                </div>

                <div class="row pt-3">
                    <div class="col-md-6">
                        <label for="Descuento">Descuento</label>
                        <input type="text" class="form-control w-75" name="Descuento" id="Descuento" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="Mora" style="vertical-align: middle">Mora</label>
                        <input type="text" class="form-control w-75" name="Mora" id="Mora" readonly>
                    </div>
                </div>

                <div class="col-md-12 pt-5">
                    <button type="button" id="btn-adddet" class="btn btn-success"><i class="fas fa-shopping-cart"></i>
                        Agregar a la lista</button>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-3">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"
                    style='background-color:#FFFFFF;'>
                    <thead class="thead-default" style="background-color:#3c8dbc; color:#fff;">
                        <th class="text-center">CONCEPTO PAGO</th>
                        <th>MONTO DE PAGO</th>
                        <th class="text-center">DESCUENTO</th>
                        <th class="text-center">MORA</th>
                        <th>IMPORTE</th>
                        <th width="10" class="text-center">ELIMINAR</th>
                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                <label for="">Total:</label>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control text-right" name="total" id="total"
                    readonly="readonly">
            </div>
        </div>

        <div class="col-md-12 text-center">
            <div id="guardar">
                <div class="form-group">
                    <button class="btn btn-primary mr-4" id="btnRegistrar" type="submit"
                        data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando">
                        <i class='fas fa-save'></i> Registrar</button>
                    <a href="{{ URL::to('pago') }}" class='btn btn-danger ml-4'><i class='fas fa-ban'></i>Cancelar</a>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection


@section('script')
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="/archivos/js/createdoc.js"></script>

    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    </script>
    <script>
        var cont = 0;
        var total = 0;
        var detallepago = [];
        var subtotal = [];
        var subtotal2 = [];
        var controlpension = [];

        function mostrardatosAlumno() {
            datosAlumno = document.getElementById('CodigoMatricula').value.split('_');
            $('#Codigo_Matricula').val(datosAlumno[0]);
            $('#DescripcionEscala').val(datosAlumno[1]);
            $('#NombreApoderado').val(datosAlumno[2]);
        }

        function mostrarMonto() {
            pension_matriculas = @json($pension_matricula);
            var alumnoBuscado = pension_matriculas.find(function(objeto) {
                return objeto['CodigoMatricula'] === datosAlumno[0];
            });
            $('#MontoPago').val(alumnoBuscado.MontoPension);
        }


        function determinarMoraDescuento() {
            concepto = document.getElementById('Concepto').value.split('_');
            fechaPago = new Date(document.getElementById('FechaPago').value);
            FechaInicio = new Date(concepto[1]);
            FechaFin = new Date(concepto[2]);
            pctjDescuento = concepto[4] / 100;
            montoPago = document.getElementById('MontoPago').value;
            montoDescuento = pctjDescuento * montoPago;

            if (fechaPago >= FechaInicio && fechaPago <= FechaFin) {
                diasTranscurridos = Math.floor((fechaPago - FechaInicio) / (1000 * 60 * 60 * 24));
                if (diasTranscurridos <= 5) {
                    $('#Descuento').val(montoDescuento);
                } else {
                    $('#Descuento').val(0);
                }
                $('#Mora').val(0);
            } else if (fechaPago > FechaFin) {
                diasTranscurridos = Math.floor((fechaPago - FechaFin) / (1000 * 60 * 60 * 24));
                $('#Descuento').val(0);
                moraTotal = concepto[3] * diasTranscurridos;
                $('#Mora').val(moraTotal);
            }
        }

        /* Mostrar Mensajes de Error */
        function mostrarMensajeError(mensaje) {
            $(".alert").css('display', 'block');
            $(".alert").removeClass("hidden");
            $(".alert").addClass("alert-danger");
            $(".alert").html("<button type='button' class='close' dataclose='alert'>×</button>" + "<span><b>Error!</b> " +
                mensaje + ".</span>");
            $('.alert').delay(5000).hide(400);
        }

        function agregarDetalle() {
            concepto = $('#Concepto option:selected').text();
            if (concepto == '- Seleccione Concepto -') {
                mostrarMensajeError("Por favor seleccione el Concepto de Pago");
                return false;
            }
            let descuento = parseFloat($("#Descuento").val());
            let mora = parseFloat($("#Mora").val());
            let montoPago = parseFloat($("#MontoPago").val());;

            concepto = document.getElementById('Concepto').value.split('_');
            cod_pension = concepto[0];
            /* Buscar que codigo de producto no se repita */
            var i = 0;
            var band = false;
            while (i < cont) {
                if (controlpension[i] == cod_pension) {
                    band = true;
                }
                i = i + 1;
            }
            if (band == true) {
                mostrarMensajeError("No puede volver a seleccionar el mismo concepto");
                return false;
            } else {
                subtotal[cont] = montoPago - descuento + mora;
                controlpension[cont] = cod_pension;
                total = total + subtotal[cont];
                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td style="text-align:right;">' + '<input type="text" name="cod_pension[]" value="' + cod_pension +
                    '"style="width:180px; text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="montoPago[]" value="' + montoPago +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="descuento[]" value="' + descuento +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + '<input type="text" name="mora[]" value="' + mora +
                    '"style="text-align:right;" readonly>' + '</td>' +
                    '<td style="text-align:right;">' + number_format(subtotal[cont], 2) + '</td>' +
                    '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(\'' +
                    cod_pension + '\',' + cont + ');"><i class="fa fa-times"></i></button></td>' +
                    '</tr>';

                $('#detalles').append(fila);
                detallepago.push({
                    concepto: cod_pension,
                    montoPago: montoPago,
                    descuento: descuento,
                    mora: mora,
                    subtotal: subtotal
                });
                cont++;
            }
            $('#total').val(number_format(total, 2));
            limpiar();
        }

        function limpiar() {
            $("#Concepto").val("0").change();
            $("#MontoPago").val('');
            $("#Descuento").val('');
            $("#Mora").val('');
        }

        /* Eliminar conceptos */
        function eliminardetalle(concepto, index) {
            total = total - subtotal[index];
            tam = detallepago.length;
            var i = 0;
            var pos;
            while (i < tam) {
                if (detallepago[i].concepto == concepto) {
                    pos = i;
                    break;
                }
                i = i + 1;
            }
            detallepago.splice(pos, 1);
            $('#fila' + index).remove();
            controlpension[index] = "";
            $('#total').val(number_format(total, 2));
        }

        function number_format(amount, decimals) {
            amount += ''; // por si pasan un numero en vez de un string
            amount = parseFloat(amount.replace(/[^09\.] /g, '')); // elimino cualquier cosa que no sea numero o punto
            decimals = decimals || 0; // por si la variable no fue pasada
            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amount) || amount === 0)
                return parseFloat(0).toFixed(decimals);
            // si es mayor o menor que cero retorno el valor formateado como numero
            amount = '' + amount.toFixed(decimals);
            var amount_parts = amount.split('.'),
                regexp = /(\d+)(\d{3})/;
            while (regexp.test(amount_parts[0]))
                amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
            return amount_parts.join('.');
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#CodigoMatricula').change(function() {
                mostrardatosAlumno();
            });

            $('#FechaPago').on('change', function() {
                determinarMoraDescuento();
            });

            $('#Concepto').change(function() {
                mostrarMonto();
                determinarMoraDescuento();
            });

            $('#btn-adddet').click(function() {
                agregarDetalle();
            });

            $('#CodigoMatricula').select2();
        });
    </script>
@endsection