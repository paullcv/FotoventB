<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(){
        return view('Catalogo.index');
    }

    public function vistaCreate(){
        return view('Catalogo.create');
    }

    public function vistaEdit($id){
        $photo = Photo::findOrFail($id); 
        return view('Catalogo.edit', compact('photo'));
    }
}
