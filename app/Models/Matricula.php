<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matricula';
    protected $primaryKey = 'CodigoMatricula';
    protected $keyType = 'string'; //necesario para que se muestre los caracteres
    public $timestamps = false;
    protected $fillable = ['CodigoAlumno', 'CodigoPeriodo', 'FechaMatricula', 'Nivel', 'Grado', 'Seccion', 'MontoMatricula', 'Estado'];

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno', 'CodigoAlumno', 'CodigoAlumno');
    }

    public function cabeceraPago()
    {
        return $this->hasMany('App\Models\CabeceraPago', 'CodigoMatricula', 'CodigoMatricula');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'CodigoPeriodo', 'CodigoPeriodo');
    }
}
