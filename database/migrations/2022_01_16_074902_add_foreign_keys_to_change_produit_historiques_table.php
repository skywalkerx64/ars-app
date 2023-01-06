<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToChangeProduitHistoriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('change_produit_historiques', function (Blueprint $table) {
            $table->foreign(['produit_id'])->references(['id'])->on('produits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('change_produit_historiques', function (Blueprint $table) {
            $table->dropForeign('change_produit_historiques_produit_id_foreign');
        });
    }
}
