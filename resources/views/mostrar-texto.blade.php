<!-- resources/views/menu/menu_textos.blade.php -->
@extends('principal-view')

@section('title', 'Textos - Aula Virtual')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/general.css') }}">
<link rel="stylesheet" href="{{ asset('css/menu_cuestionario.css') }}">
@endpush
@section('header', 'Textos')

@section('content')
<section class="contenido-documento" style="margin-left:400px; max-width: 700px;">
    @foreach($documentos as $documento)
        <h2>{{ $documento['titulo'] }}</h2>
        <!-- Mostrar el contenido formateado -->
        <div>{!! $documento['contenido'] !!}</div>
        <!-- Mostrar la imagen asociada, si existe -->
        @if ($documento['imagen'])
            <div>
                <img src="{{ $documento['imagen'] }}" alt="Imagen de {{ $documento['titulo'] }}" style="max-width: 300px;">
            </div>
        @else
            <div>
                <img src="{{ asset('imagenes/placeholder.jpg') }}" alt="Placeholder">
            </div>
        @endif
        <!-- Formulario para eliminar documento -->
        @if (Auth::user()->isDocente())
            <!-- Formulario para eliminar documento -->
            <form action="{{ route('eliminar', ['titulo' => $documento['titulo']]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        @endif
        <hr>
    @endforeach
    <hr>
</section>
@endsection
