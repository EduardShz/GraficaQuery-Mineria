<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'ocupaciones';
    protected $primaryKey = 'cve_ocupaciones';
    public $timestamps = false;

    protected $fillable = [
        'cve_detalles_vuelos',
        'cve_clientes'
    ];
}
