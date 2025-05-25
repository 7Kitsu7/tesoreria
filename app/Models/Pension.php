<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;

    protected $table = 'pension';
    protected $primaryKey = ['Concepto','CodigoPeriodo'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['FechaInicio','FechaVencimiento','Mora_dia','Descuento'];

    public function periodo()
    {
        return $this->hasOne('App\Models\Periodo', 'CodigoPeriodo', 'CodigoPeriodo');
    }

}
