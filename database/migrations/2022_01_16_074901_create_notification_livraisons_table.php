<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_livraisons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->nullable();
            $table->enum('statut', ['L', 'LP', 'NL'])->default('NL');
            $table->enum('categorie', ['M', 'C', 'NC']);
            $table->unsignedBigInteger('echeance');
            $table->unsignedBigInteger('agence_id')->index('notification_livraisons_agence_id_foreign');
            $table->unsignedBigInteger('carte_id')->index('notification_livraisons_carte_id_foreign');
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
        Schema::dropIfExists('notification_livraisons');
    }
}
