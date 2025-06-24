<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'cve_clientes';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'fecha_nacimiento',
        'cve_estados',
        'cve_municipios'
    ];
}
