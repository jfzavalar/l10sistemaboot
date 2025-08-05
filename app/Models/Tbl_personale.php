<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_personale extends Model
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
        
        'activo',
        //
        'created_user',
        'updated_user'
    ];
}
