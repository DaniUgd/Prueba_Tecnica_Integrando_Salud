<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = "pacientes";
    protected $fillable = [
        "nombre",
        "apellido",
        "sexo",
        "dni",
        "fecha_nacimiento",
    ];
      protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->created_at = now();
            $model->updated_at = null;
        });
    }
    public function tratamientos(){
        return $this->hasMany(Tratamiento::Class, 'pacientes_id');
    }
}