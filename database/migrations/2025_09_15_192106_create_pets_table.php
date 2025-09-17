<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('color',['verde','amarillo','ambar','rojo']); 
            $table->tinyInteger('intensidad')->unsigned(); //entre 1 y 10
            $table->integer('duracion_minutos');
            $table->boolean('requiere_ayuno'); //si o no
            $table->text('observaciones');
            $table->boolean('activo')->default(true); //borrado logico
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
