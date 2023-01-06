<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCarteEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carte_evolutions', function (Blueprint $table) {
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
        Schema::table('carte_evolutions', function (Blueprint $table) {
            $table->dropForeign('carte_evolutions_carte_id_foreign');
        });
    }
}
