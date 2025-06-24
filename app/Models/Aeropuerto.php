<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuertos';
    protected $primaryKey = 'cve_aeropuertos';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'clave_internacional',
        'cve_ciudades',
    ];
}
