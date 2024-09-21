<!-- resources/views/menu/menu_textos.blade.php -->
@extends('principal-view')

@section('title', 'Textos - Aula Virtual')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/general.css') }}">
<link rel="stylesheet" href="{{ asset('css/menu_cuestionario.css') }}">
@endpush
@section('header', 'Textos')

@section('content')
<section class="galeria-cuestionario">   
    <div class="cuestionario">
        <a href="enlace_texto50.html">
            <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_1">
        </a>
        <p>Cuestionario 1 'Lab 3.5'</p>
    </div> 
    <div class="cuestionario">
        <a href="enlace_texto50.html">
            <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_2">
        </a>
        <p>Cuestionario 2 'Lab 3.5'</p>
    </div> 
    <div class="cuestionario">
        <a href="enlace_texto50.html">
            <img src="{{ asset('imagenes/portada_3.jpg') }}" alt="Cuestionario_3">
        </a>
        <p>Cuestionario 3 'Lab 3.5'</p>
    </div> 
</section>
@endsection