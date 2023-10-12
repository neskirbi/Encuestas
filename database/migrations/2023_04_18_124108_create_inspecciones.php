<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_encuesta',32);
            $table->string('obra',500);
            $table->string('razonsocial',500);
            $table->string('repre',150);
            $table->string('calle',500);
            $table->string('numeroext',50);
            $table->string('numeroint',50);
            $table->string('colonia',500);
            $table->string('municipio',500);
            $table->string('entidad',50);
            $table->string('fechainicio',50);
            $table->string('fechafin',50);
            $table->string('nbo',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspecciones');
    }
}
