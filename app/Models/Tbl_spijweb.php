<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_spijweb extends Model
{
    use HasFactory;

    protected $fillable = [
        //'id',
        'dni',
        'datos',
        'sede',
        'dependencia',
        'regimen',
        'cargo',
        'correo_personal',
        'correo_institucional',
        'cel_personal',
        'cel_institucional',
        'actaruta',
        'usuariospijweb',
        'passwordspijweb',
        'estado_formato',
        'estado_userpass',
        'activo',
        //
        'created_user',
        'updated_user'
    ];
}
