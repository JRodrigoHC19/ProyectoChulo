<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'id',
        'pais',
        'ciudad',
        'direccion',
        // otros atributos permitidos
    ];

    public static function getEmail($correo){
        $hotel = Hotel::where('email', $correo)->first();
        
        if (isset($hotel)){
            return $hotel->email;
        } else {
            return null;
        }    
    }
    
    public static function getRuc($email){
        $hotel = Hotel::where('email', $email)->first();
        
        if (isset($hotel)){
            return $hotel->id;
        } else {
            return null;
        }    
    }

    public static function getPais($pais){
        $hotel = Hotel::where('email', $pais)->first();
        
        if (isset($hotel)){
            return $hotel->pais;
        } else {
            return null;
        }
    }

    public static function getCiudad($ciudad){
        $hotel = Hotel::where('email', $ciudad)->first();
        
        if (isset($hotel)){
            return $hotel->ciudad;
        } else {
            return null;
        }
    }

    public static function getDireccion($direcion){
        $hotel = Hotel::where('email', $direcion)->first();
        
        if (isset($hotel)){
            return $hotel->direccion;
        } else {
            return null;
        }
    }

    public static function getNombre($correo){
        $hotel = Hotel::where('email', $correo)->first();
        
        if (isset($hotel)){
            return $hotel->titulo;
        } else {
            return null;
        }
    }

    public static function getFull($name){
        $hotel = Hotel::where('titulo', $name)->get();

        if (isset($hotel)){
            return $hotel;
        } else {
            return null;
        }
    }
}
