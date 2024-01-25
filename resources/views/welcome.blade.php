@extends('plantillas.plantilla')

@section('titulo')
    Inicio Peliculas
@endsection

@section('cabecera')
    Tarea 5 <strong> Todas las Peliculas</strong>
@endsection

@section('contenido')

<div class="p-2 border-2 border-gray-500 shadow-xl rounded-xl w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach ($films as $item)
            <article style="background-image:url({{ Storage::url($item -> imagen) }})" @class([
                'h-72 bg-cover bg-center bg-no-repeat',
                // $loop -> first : Solo va a realizar esa condición en la primera iteración del bucle.
                'md:col-span-2 lg:col-span-2' => $loop -> first,
            ])>
                <a href="{{ route('films.show', $item) }}">
                    <div class="w-full h-full flex flex-col justify-around items-center p-2 bg-gray-200 bg-opacity-50">
                        <div class="text-xl font-bold underline text-black">
                            {{ $item -> titulo }}
                        </div>
                        <div class="flex">
                            @foreach ($item -> tags as $tag)
                                <div class="font-semibold py-1 px-2 rounded-full mr-1"
                                    style="background-color: {{ $tag -> color }}">
                                    {{ $tag -> nombre }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
    <div class="my-2 mx-2">
        {{ $films -> links() }}
    </div>
@endsection




