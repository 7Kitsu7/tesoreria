<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePago extends Model
{
    use HasFactory;
    protected $table = 'detallepagos';
    protected $primaryKey = ['NroPago', 'Concepto', 'CodigoPerido'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['NroPago', 'Concepto', 'CodigoPerido', 'MontoPago', 'Mora', 'Descuento'];

    // public function pago()     {         
    //     return $this->belongsTo(CabeceraPago::class,'NroPago','NroPago');    
    //  }

    public function pago()
    {
        return $this->belongsTo(CabeceraPago::class, ['NroPago', 'Concepto', 'CodigoPerido'], ['NroPago', 'Concepto', 'CodigoPerido']);
    }

    public function pensiones()
    {
        return $this->belongsToMany('App\Models\Pension', 'Concepto', 'Concepto');
    }
}
