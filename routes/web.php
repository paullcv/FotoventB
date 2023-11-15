<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SubscripcionController;
use App\Http\Middleware\Fotografos;
use App\Http\Middleware\Organizadores;
use App\Http\Middleware\Subscripcion;
use App\Livewire\Evento\Create;
use App\Livewire\Evento\Show;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('inicio');
        })->name('dashboard');
    });

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');


//Metodos de Pago
Route::get('/paymentMethod', [PagoController::class, 'index'])
    ->middleware('auth')
    ->name('paymentMethod');


//Subscripciones
Route::get('/subscripcion', [SubscripcionController::class, 'index'])
    ->middleware('auth')
    ->name('subscripcion');


//Eventos
Route::get('/evento', [EventController::class, 'index'])
    ->middleware('auth')
    //->middleware(Subscripcion::class)
    ->name('evento.index');

Route::get('evento/eventoCreate', [EventController::class, 'vistaCreate'])
    ->middleware('auth')
    //->middleware(Subscripcion::class)
    ->name('evento.create');

Route::get('evento/eventoEdit/{id}', [EventController::class, 'vistaEdit'])
    ->middleware('auth')
    //->middleware(Subscripcion::class)
    ->name('evento.edit');


// Catalogo de Fotos
Route::get('/catalogo', [CatalogoController::class, 'index'])
    ->middleware('auth')
    ->name('catalogo.index');

Route::get('/catalogo/create', [CatalogoController::class, 'vistaCreate'])
    ->middleware('auth')
    ->name('catalogo.create');

//Presentacion (Perfil Profesional del Fotografo)
Route::get('/Presentacion', [PresentationController::class, 'index'])
    ->middleware('auth')
    ->middleware(Fotografos::class)
    ->name('presentacion.index');
