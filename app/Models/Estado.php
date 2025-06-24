<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'cve_estados';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'abreviatura',
    ];
}
