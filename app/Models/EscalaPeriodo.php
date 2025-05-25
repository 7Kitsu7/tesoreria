<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalaPeriodo extends Model
{
    use HasFactory;

    protected $table = 'escala_periodo';
    protected $primaryKey = ['CodigoPeriodo', 'CodigoEscala'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['MontoMatricula','MontoPension'];

    public function periodo()
    {
        return $this->hasOne('App\Models\Escala', 'CodigoPeriodo', 'CodigoPeriodo');
    }

    public function escala()
    {
        return $this->hasOne('App\Models\Escala', 'CodigoEscala', 'CodigoEscala');
    }
}
