<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carte_id')->nullable()->index('ventes_carte_id_foreign');
            $table->unsignedBigInteger('produit_id')->nullable()->index('ventes_produit_id_foreign');
            $table->unsignedBigInteger('cout')->nullable();
            $table->unsignedBigInteger('tranche')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
