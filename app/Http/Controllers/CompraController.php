<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        // Obtener todas las fotos relacionadas con los eventos del usuario
        $userPhotos = Photo::whereHas('event', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('compra.index', compact('userPhotos'));
    }

    public function detalles(Photo $photo){
        return view('compra.detail', compact('photo'));
    }
}
