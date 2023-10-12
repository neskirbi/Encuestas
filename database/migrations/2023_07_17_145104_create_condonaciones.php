<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondonaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condonaciones', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_administrador',32)->default('');
            $table->string('id_cliente',32)->default('');
            $table->string('id_obra',32)->default('');
            $table->string('id_planta',32);
            $table->float('monto',20,2);
            
            $table->string('detalle',150)->default('');
            
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
        Schema::dropIfExists('condonaciones');
    }
}
