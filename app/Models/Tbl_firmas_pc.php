<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_firmas_pc extends Model
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
        //
        'idtoken',
        'codtoken',
        'operativo',
        'asignacion',
        'fecha_expiracion',
        'observacion',
        'actaruta',
        'activo',
        //
        'created_user',
        'updated_user'
    ];
}
