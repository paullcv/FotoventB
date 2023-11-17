@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Detalles de la foto
        </h2>
    </div>

    <div class="py-12">
        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-7">
                <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="card-body px-8 py-6">
                        <div class="flex">
                            <figure>
                                <img class="w-96 h-96 object-cover object-center"
                                    src="{{ asset('storage/' . $photo->image) }}" alt="">
                            </figure>

                            <div class="flex-1 ml-4">
                                <h1 class="text-lg text-gray-500 font-semibold">
                                    {{ $photo->event->nombre }}
                                </h1>

                                <h1 class="text-lg text-gray-500 font-semibold">
                                    {{ $photo->price }} Bs
                                </h1>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-span-5">
                @livewire('compra.pay-photo', ['photo' => $photo])
            </div>
        </div>
    </div>
@endsection
