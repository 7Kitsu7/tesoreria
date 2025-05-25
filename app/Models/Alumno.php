<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumno';
    protected $primaryKey = 'CodigoAlumno';
    protected $keyType = 'string'; //necesario para que se muestre los caracteres
    public $timestamps = false;
    protected $fillable = ['Nombres', 'Apellidos', 'Dni', 'Telefono', 'FechaNacimiento', 'Direccion', 'Sexo', 'Email', 'CodigoEscala', 'NombreApoderado'];

    public function escala()
    {
        return $this->hasOne('App\Models\Escala', 'CodigoEscala', 'CodigoEscala');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'CodigoAlumno', 'CodigoAlumno');
    }
}
