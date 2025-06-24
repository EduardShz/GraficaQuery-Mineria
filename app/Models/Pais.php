<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'cve_paises';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'clave_internacional',
        'cve_continentes',
    ];
}
