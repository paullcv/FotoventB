<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(){
        return view('Catalogo.index');
    }

    public function vistaCreate(){
        return view('Catalogo.create');
    }
}
