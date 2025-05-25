@extends('layouts.plantilla')

@section('contenido')
    <h1>Bienvenido: {{ auth()->user()->name }}</h1>
@endsection
