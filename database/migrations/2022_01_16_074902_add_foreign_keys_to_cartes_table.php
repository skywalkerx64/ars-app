<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cartes', function (Blueprint $table) {
            $table->foreign(['agent_id'])->references(['id'])->on('agents');
            $table->foreign(['client_id'])->references(['id'])->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartes', function (Blueprint $table) {
            $table->dropForeign('cartes_agent_id_foreign');
            $table->dropForeign('cartes_client_id_foreign');
        });
    }
}
