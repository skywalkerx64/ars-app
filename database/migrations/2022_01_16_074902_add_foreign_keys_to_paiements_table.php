<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->foreign(['agent_id'])->references(['id'])->on('agents');
            $table->foreign(['client_id'])->references(['id'])->on('clients');
            $table->foreign(['carte_id'])->references(['id'])->on('cartes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign('paiements_agent_id_foreign');
            $table->dropForeign('paiements_client_id_foreign');
            $table->dropForeign('paiements_carte_id_foreign');
        });
    }
}
