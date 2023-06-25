<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index(){
        return view('admin.usuarios');
    }

    public function registrar(Request $request){
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->rol = 'M';
        $user->save();
        
        $hotel = new Hotel();
        $hotel->id = $request->input('id');
        $hotel->email = $request->input('email');
        $hotel->titulo = $request->input('name');
        $hotel->pais = $request->input('pais');
        $hotel->ciudad = $request->input('ciudad');
        $hotel->direccion = $request->input('direccion');
        $hotel->save();   

        return redirect()->route("cuentas");
    }

    public function store(Request $request){
        dd($request->all());
    }

    public function editTitulo(string $correo, Request $request){
        $registro = Hotel::where('email', $correo)->first();
        $registro->titulo = $request->input('titulo');
        $registro->save();

        $usuario = User::where('email', $correo)->first();
        $usuario->name = $request->input('titulo');
        $usuario->save();
        return redirect()->back();
    }

    public function editLocation(string $correo, Request $request){
        $registro = Hotel::where('email', $correo)->first();
        $registro->pais = $request->input('pais');
        $registro->ciudad = $request->input('ciudad');
        $registro->direccion = $request->input('direccion');
        $registro->save();

        return redirect()->back();
    }

}
