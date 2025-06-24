<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = 'vuelos';
    protected $primaryKey = 'cve_vuelos';
    public $timestamps = false;

    protected $fillable = [
        'cve_aerolineas',
        'cve_aeropuertos_origen',
        'cve_aeropuertos_destino',
    ];
}
