<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        // Obtener todas las fotos relacionadas con los eventos públicos del usuario
        $userPhotos = Photo::where(function ($query) {
            // Fotos de eventos públicos del usuario
            $query->whereHas('event', function ($eventQuery) {
                $eventQuery->where('user_id', auth()->id())
                    ->where('visibilidad', 'publico');
            });

            // Fotos que tienen el ID del usuario en la tabla coincidencias
            $query->orWhereHas('coincidencias', function ($coincidenciasQuery) {
                $coincidenciasQuery->where('user_id', auth()->id());
            });
        })->get();


        return view('compra.index', compact('userPhotos'));
    }

    public function detalles(Photo $photo)
    {
        return view('compra.detail', compact('photo'));
    }
}
