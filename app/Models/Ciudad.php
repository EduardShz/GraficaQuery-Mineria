<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';
    protected $primaryKey = 'cve_ciudades';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'cve_paises',
    ];
}
