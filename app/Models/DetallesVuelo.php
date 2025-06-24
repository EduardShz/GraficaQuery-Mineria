<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallesVuelo extends Model
{
    protected $table = 'detalles_vuelos';
    protected $primaryKey = 'cve_detalles_vuelos';
    public $timestamps = false;

    protected $fillable = [
        'fecha_hora_salida',
        'capacidad',
        'cve_vuelos',
    ];
}
