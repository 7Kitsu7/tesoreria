<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $table = 'periodo';
    protected $primaryKey = 'CodigoPeriodo';
    public $timestamps = false;
    protected $fillable = ['FechaInicio', 'FechaTermino','Estado'];

    public function escala_periodo()
    {
        return $this->hasMany(EscalaPeriodo::class, 'CodigoPeriodo');
    }

    public function pensiones()
    {
        return $this->hasMany(Pension::class, 'CodigoPeriodo');
    }
}
