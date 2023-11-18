<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraciasController extends Controller
{
    public function gracias(){
        return view('compra.gracias');
    }
}
