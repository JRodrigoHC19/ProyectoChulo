<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cuentas()
    {
        return view('admin.usuarios');
    }

    public function hotelpublic()
    {
        return view('hotel.recepcionpublic');
    }

    public function hotel($name)
    {
        return view('hotel.recepcion',['name' => $name]);
    }

    public function perfil($id)
    {
        return view('configuration.perfil',['id' => $id]);
    }

    public function reservacion($id)
    {
        return view('reservation.reservacion', ['id' => $id]);
    }

    public function graficas($id)
    {
        return view('hotel.graphics.graficas',['id' => $id]);
    }

}
