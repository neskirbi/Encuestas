<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectores', function (Blueprint $table) {
            $table->string('id',32)->unique();            
            $table->string('id_uia',32);
            $table->string('inspector',150);
            $table->string('telefono',20);
            $table->string('mail',150);
            $table->string('pass',20);
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
        Schema::dropIfExists('inspectores');
    }
}
