<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{

    use HasFactory;

    protected $table = 'escala';
    protected $primaryKey = 'CodigoEscala';
    protected $keyType = 'string'; //necesario para que se muestre los caracteres
    public $timestamps = false;
    protected $fillable = ['DescripcionEscala'];

    public function escala_periodo()
    {
        return $this->hasMany(EscalaPeriodo::class, 'CodigoEscala');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'CodigoEscala');
    }

}
