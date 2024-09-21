<!-- resources/views/menu/menu_textos.blade.php -->
@extends('principal-view')

@section('title', 'Textos - Aula Virtual')

@section('header', 'Textos')

@section('content')
<section class="galeria-textos">
    @forelse($documentos as $documento)
        <div class="texto">
            <a href="{{ route('mostrar-texto', ['id' => $documento['id']]) }}">
                <p style="padding-bottom: 8px;">{{ $documento['titulo'] }}</p>
                <!-- Mostrar la imagen asociada, si existe -->
                @php
                    $nombreImagen = Str::slug($documento['titulo'], '-') . '.jpg';
                @endphp

                @if (file_exists(public_path("images/{$nombreImagen}")))
                    <div>
                        <img src="{{ asset("images/{$nombreImagen}") }}" alt="Imagen de {{ $documento['titulo'] }}">
                    </div>
                @endif
            </a>
        </div>
    @empty
        <p>No hay documentos disponibles.</p>
    @endforelse
</section>
@endsection
