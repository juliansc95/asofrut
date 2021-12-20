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

            $table->date('fechaVenta');
            $table->decimal('totalVenta', 11, 2);
            $table->decimal('totalKilos', 11, 2);
            $table->unsignedInteger('estado_id');                                 
            $table->timestamps();
        });

        

        Schema::table('ventas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('lugarVenta_id')->references('id')->on('lugarVentas');
            $table->foreign('estado_id')->references('id')->on('estadoVentas');
        });

        echo "Creando tabla de ventas_categorias ".__LINE__."\n";
        Schema::create('ventas_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ventas_id');
            $table->unsignedInteger('categoria_id');
            $table->decimal('peso', 11, 2);
            $table->decimal('valorUnitario', 11, 2);
            $table->decimal('subtotal', 11, 2);
            $table->decimal('donacion', 11, 2);
            $table->decimal('transporte', 11, 2);
            $table->decimal('asohof', 11, 2);
            $table->decimal('cuatroXmil', 11, 2);
            $table->text('otro')->nullable();
            $table->timestamps();
        });

        Schema::table('ventas_categorias', function (Blueprint $table) {
            $table->foreign('ventas_id')->references('id')->on('ventas');
            $table->foreign('categoria_id')->references('id')->on('categoriaMoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
