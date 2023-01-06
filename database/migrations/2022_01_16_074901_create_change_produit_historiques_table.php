<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeProduitHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_produit_historiques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produit_id')->index('change_produit_historiques_produit_id_foreign');
            $table->unsignedBigInteger('changes_count');
            $table->double('previous_prix')->unsigned();
            $table->double('previous_prix_2')->unsigned();
            $table->double('new_prix')->unsigned();
            $table->double('new_prix_2')->unsigned();
            $table->double('montant');
            $table->double('montant_2');
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
        Schema::dropIfExists('change_produit_historiques');
    }
}
