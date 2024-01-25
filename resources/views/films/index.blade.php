@extends('plantillas.plantilla')

@section('titulo')
    Gestionar Post
@endsection

@section('cabecera')
    Gestionar todos las <strong>Películas</strong>
@endsection

@section('contenido')

<div class="mx-auto w-3/4 p-8">
        <div class="my-2 flex flex-row-reverse">
            <a href="{{route('films.create')}}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fas fa-add"></i>
                NUEVO</a>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            INFO
                        </th>
                        <th scope="col" class="px-6 py-3">
                            TÍTULO
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $item )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{route('films.show' , $item)}}"> <!--Es la ruta de informacion, por lo tanto espera que le pasemos un posts ($item)-->
                                <i class="fas fa-info text-xl text-blue-400 hover:text-2xl"></i>
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{$item -> titulo}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item -> descripcion}}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('films.destroy' , $item)}}" method="POST">
                               @csrf
                               @method('delete')
                               <a href="{{route('films.edit' , $item)}}"><i class="fas fa-edit text-yellow-600"></i></a>
                                <button type="submit">
                                    <i class="fas fa-trash text-red-400 hover:text-2xl"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="mt-2">
        {{$films -> links()}}
    </div>
@endsection