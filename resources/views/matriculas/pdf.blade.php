@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Matricula</title>
</head>

<body>

    <div style="margin-top: 45px">
        <div style="margin-left: 170px; margin-bottom: 10px">
            <img src="../public/adminlte/images/logo_San_Juan.png" height="90px" style="display: inline">
            <h1 style="display: inline-block; margin-left: 30px; margin-top: -30px; color: rgb(92, 90, 90)">I.E. SAN
                JUAN</h1>
        </div>

        <h2 style="margin-left: 170px; color: rgb(92, 90, 90); margin-top: 0">FICHA DE MATRÍCULA N°
            {{ $matricula->CodigoMatricula }}</h2>

        <h3 style="display: inline-block; margin-left: 50px; margin-top: 20px; color: rgb(89, 87, 87)">Fecha de pago:
            {{ Carbon::parse($matricula->FechaMatricula)->format('d/m/Y') }}</h3>

        <h3 style="display: inline-block; margin-left: 290px; margin-top: 20px; color: rgb(89, 87, 87)">PAGADA</h3>

        <div style="margin-left: 50px">
            <div>
                <h3 style="margin-top: 0; margin-bottom: 5px; color: rgb(92, 90, 90);">ESTUDIANTE</h3>
                <p>{{ $matricula->alumno->Apellidos }} {{ $matricula->alumno->Nombres }}</p>
                <p>Código: {{ $matricula->CodigoAlumno }}</p>
                <p>Nivel Académico: {{ $matricula->Nivel }}</p>
                <p>Grado académico: {{ $matricula->Grado }}</p>
                <p>Sección: {{ $matricula->Seccion }}</p>
                <p>DNI: {{ $matricula->alumno->Dni }}</p>
                <p>Fecha de Nacimiento:
                    {{ Carbon::parse($matricula->alumno->FechaNacimiento)->format('d/m/Y') }}</p>
                <p>Teléfono: {{ $matricula->alumno->Telefono }}</p>
                <p>Escala: {{ $matricula->alumno->escala->DescripcionEscala }}</p>
                <p>Correo electrónico: {{ $matricula->alumno->Email }}</p>
            </div>

            <div>
                <h3 style="margin-top: 20px; margin-bottom: 5px; color: rgb(92, 90, 90);">APODERADO</h3>
                <p>{{ $matricula->alumno->NombreApoderado }}</p>
                <p>Dirección de domicilio: {{ $matricula->alumno->Direccion }}</p>
            </div>
        </div>

        <h2 style="margin-left: 50px; color: rgb(92, 90, 90);">MONTO MATRÍCULA: S/. {{ $matricula->MontoMatricula }}</h2>

        <img src="../public/adminlte/images/barras.png" alt="" width="630px" height="150px" style="margin-left: 50px; margin-top: 2px">

    </div>

</body>

</html>
