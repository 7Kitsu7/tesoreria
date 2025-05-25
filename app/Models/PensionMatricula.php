<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PensionMatricula extends Model
{
    use HasFactory;
    protected $table = 'pension_matricula';
    protected $primaryKey = ['Concepto','CodigoPeriodo','CodigoMatricula'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['MontoPension','Estado'];
}
