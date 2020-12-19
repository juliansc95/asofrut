<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function(Blueprint $table){
            $table->decimal('totalDonacion', 11, 2)->after('totalKilos');
            $table->decimal('totalTransporte', 11, 2)->after('totalDonacion');
            $table->decimal('totalAsohof', 11, 2)->after('totalTransporte');
            $table->decimal('totalCuatroXmil', 11, 2)->after('totalAsohof');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas_categorias',function(Blueprint $table){
            $table->dropColumn(['donacion']);
            $table->dropColumn(['transporte']);
            $table->dropColumn(['asohof']);
            $table->dropColumn(['cuatroXmil']);
            $table->dropColumn(['otro']);
        });
    }
}
