<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNotificationLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_livraisons', function (Blueprint $table) {
            $table->foreign(['agence_id'])->references(['id'])->on('agences');
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
        Schema::table('notification_livraisons', function (Blueprint $table) {
            $table->dropForeign('notification_livraisons_agence_id_foreign');
            $table->dropForeign('notification_livraisons_carte_id_foreign');
        });
    }
}
