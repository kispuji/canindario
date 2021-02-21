<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProfileForm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Cambiar vistas
Route::middleware(['auth:sanctum', 'verified'])->get('/trabajadores', ProfileForm::class)->name('trabajadores');
//Route::get('trabajadores', ProfileForm::class)->name('trabajadores');
Route::middleware(['auth:sanctum', 'verified'])->get('/perros', function () {
    return view('dashboard');
})->name('perros');

Route::middleware(['auth:sanctum', 'verified'])->get('/entrenamientos', function () {
    return view('dashboard');
})->name('entrenamientos');

Route::middleware(['auth:sanctum', 'verified'])->get('/informes', function () {
    return view('dashboard');
})->name('informes');

Route::get('/profile', ProfileForm::class)->name('profile');
