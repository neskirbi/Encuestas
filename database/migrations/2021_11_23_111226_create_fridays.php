<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFridays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fridays', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_administrador',32);
            $table->string('titulo',100);
            $table->longtext('detalle');
            $table->integer('prioridad',false,false);
            $table->string('status',1)->default(0);
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
        Schema::dropIfExists('fridays');
    }
}
