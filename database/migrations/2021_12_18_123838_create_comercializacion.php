<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComercializacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de  productos por comercializar".__LINE__."\n";
        Schema::create('productosComers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->decimal('valorUnitario', 11, 0);
            $table->timestamps();
        });

        echo "Creando tabla de ventas de comercializacion ".__LINE__."\n";
        Schema::create('comercializacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->text('otro')->nullable();
            $table->date('fechaVenta');
            $table->decimal('totalVenta', 11, 2);
            $table->decimal('totalUnidades', 11, 2);
            $table->timestamps();
        }); 

        

        Schema::table('comercializacions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
        });

        echo "Creando tabla de ventas_categorias ".__LINE__."\n";
        Schema::create('comercializacionProductos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comercializacion_id');
            $table->unsignedInteger('productosComers_id');
            $table->decimal('cantidad', 11, 2);
            $table->decimal('valorUnitario', 11, 2);
            $table->text('otro')->nullable();
            $table->timestamps();
        });

        Schema::table('comercializacionProductos', function (Blueprint $table) {
            $table->foreign('comercializacion_id')->references('id')->on('comercializacions');
            $table->foreign('productosComers_id')->references('id')->on('productosComers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productosComers');
        Schema::dropIfExists('comercializacions');
        Schema::dropIfExists('comercializacionProductos');
    }
}
