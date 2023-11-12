<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        return view('Event.index');
    }

    public function vistaCreate(){
        return view('Event.create');
    }

    public function vistaEdit(){
        return view('Event.create');
    }
}
