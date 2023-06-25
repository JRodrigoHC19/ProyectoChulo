<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public static function getPais($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->pais;
        } else {
            return null;
        }
    }

    public static function getCelular($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->celular;
        } else {
            return null;
        }
    }

    public static function getNombre($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->nombre;
        } else {
            return null;
        }
    }

    public static function getApellido($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->apellido;
        } else {
            return null;
        }
    }
    
    public static function getSexo($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->sexo;
        } else {
            return null;
        }
    }
    
    public static function getNacimiento($correo){
        $persona = Persona::where('email', $correo)->first();
        
        if (isset($persona)){
            return $persona->fecha_nac;
        } else {
            return null;
        }
    }
    
}
