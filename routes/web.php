<?php

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

Auth::routes();

Route::get('/cuentas/registrado', function () {
    return view('admin.usuarios');
});

// para verificar qué datos se a enviado: en este ruta, indique esto:
// ...('/ruta/', [App\Http\Controllers\Controller::class, 'queseenvio'])... 
// solo funciona cuando solo se quiere enviar los datos de un formulario

// RUTAS PARA TODOS SIN EXCEPCION
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS SOLO PARA USUARIOS
Route::get('/usuario/{id}/configuracion/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil-usuario');
Route::get('/usuario/{id}/edit/celular', [App\Http\Controllers\PersonaController::class, 'editCelular'])->name('editar-celular');
Route::get('/usuario/{id}/edit/datospersonales', [App\Http\Controllers\PersonaController::class, 'editDatosPersonales'])->name('editar-datos-personales');


// RUTAS SOLO PARA HOTELES
Route::get('/hotel/{id}/configuracion/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');
Route::get('/hotel/', [App\Http\Controllers\HomeController::class, 'hotelpublic'])->name('hotel');
Route::get('/hotel/{name}', [App\Http\Controllers\HomeController::class, 'hotel'])->name('editar-presentacion');
Route::get('/hotel/{id}/reservacion', [App\Http\Controllers\HomeController::class, 'reservacion'])->name('reservacion');
Route::get('/hotel/{id}/graficas', [App\Http\Controllers\HomeController::class, 'graficas'])->name('graficas');
Route::get('/hotel/{id}/edit/titulo', [App\Http\Controllers\HotelController::class, 'editTitulo'])->name('editar-titulo');
Route::get('/hotel/{id}/edit/location', [App\Http\Controllers\HotelController::class, 'editLocation'])->name('editar-lotation');
Route::get('/hotel/{id}/edit/name', [App\Http\Controllers\Controller::class, 'editName'])->name('editar-name');
Route::get('/hotel/{id}/edit/password', [App\Http\Controllers\Controller::class, 'editPassword'])->name('editar-password');


// CRUD de la RESERVACIÓN
Route::get('/hotel/reservacion/habitaciones',[App\Http\Controllers\HabitacionController::class,'show'])->name('buscar_hab');


// RUTAS SOLO PARA ADMINISTRADORES
Route::get('/cuentas', [App\Http\Controllers\HomeController::class, 'cuentas'])->name('cuentas');
// RUTAS PARA CREAR UNA CUENTA HOTEL Y USUARIO
Route::get('/cuentas/registar/hotel', [App\Http\Controllers\HotelController::class,'registrar'])->name('registrar_hot');
Route::post('/registar/usuario', [App\Http\Controllers\PersonaController::class,'store'])->name('registrar_usu');