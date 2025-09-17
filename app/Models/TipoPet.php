<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TipoPet extends Model
{
    protected $table = 'pets';

    protected $fillable = [
        'nombre',
        'color',
        'intensidad',
        'duracion_minutos',
        'requiere_ayuno',
        'activo',
        'observaciones',
    ];

    protected $casts = [
        'intensidad'       => 'integer',
        'duracion_minutos' => 'integer',
        'requiere_ayuno'   => 'boolean',
        'activo'           => 'boolean',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->created_at = now();
            $model->updated_at = null;
        });
    }
     public function tratamientos(){
        return $this->hasMany(Tratamiento::Class, 'pets_id');
    }
}
