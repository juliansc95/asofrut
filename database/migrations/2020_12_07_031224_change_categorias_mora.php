<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCategoriasMora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoriaMoras', function(Blueprint $table){
            $table->decimal('valorUnitario', 11, 2)->after('nombre');
            $table->decimal('valorDonacion', 11, 2);
            $table->decimal('valorTransporte', 11, 2);
            $table->decimal('valorAsohof', 11, 2);
            $table->decimal('valorCuatroPorMil', 11, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoriaMoras', function(Blueprint $table){
            $table->decimal('valorUnitario', 11, 2)->after('nombre');
            $table->decimal('valorDonacion', 11, 2);
            $table->decimal('valorTransporte', 11, 2);
            $table->decimal('valorAsohof', 11, 2);
            $table->decimal('valorCuatroPorMil', 11, 2);
        });
    }
}
