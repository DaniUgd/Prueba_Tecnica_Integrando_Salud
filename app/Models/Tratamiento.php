<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\TipoPet;
class Tratamiento extends Model
{
    protected $table = 'tratamientos';

    protected $fillable = [
        'pacientes_id',  // FK a pacientes
        'pets_id',       // FK a pets (tipos de PET)
        'fecha_inicio',
    ];

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pacientes_id');
    }

    public function pet() // tipo de PET
    {
        return $this->belongsTo(TipoPet::class, 'pets_id');
    }
}