@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Eventos
        </h2>
    </div>
    <div class="flex justify-between items-center mb-6">
        <a href="{{route('evento.create')}}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Crear Evento
        </a>
    </div>

    @livewire('evento.show')
@endsection
