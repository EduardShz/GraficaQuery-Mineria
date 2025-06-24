<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'cve_municipios',
        'cve_estados',
        'nombre',
    ];
}
