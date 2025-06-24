<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aerolinea extends Model
{
    protected $table = 'aerolineas';
    protected $primaryKey = 'cve_aerolineas';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'flota',
        'numero_destinos',
        'fecha_inicio_operaciones',
        'cve_paises',
        'cve_aeropuertos__principal',
    ];
}
