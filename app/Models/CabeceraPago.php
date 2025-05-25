<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabeceraPago extends Model
{
    use HasFactory;
    protected $table = 'cabecerapagos';
    protected $primaryKey = 'NroPago';
    public $timestamps = false;
    protected $fillable = ['CodigoMatricula', 'FechaPago', 'Estado', 'Total'];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'CodigoMatricula', 'CodigoMatricula');
    }

    public function detallepagos()
    {
        return $this->hasMany(DetallePago::class, 'NroPago', 'NroPago');
    }
}