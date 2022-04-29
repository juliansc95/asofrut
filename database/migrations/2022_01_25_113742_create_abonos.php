<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando abonos y deuda ".__LINE__."\n";
        Schema::create('abonos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->decimal('valorAbonado', 11, 2);
            $table->decimal('saldo', 11, 2);
            $table->timestamps();
        }); 

        Schema::table('abonos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonos');
    }
}
