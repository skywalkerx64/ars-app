<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteEvolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_evolutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('mois');
            $table->unsignedInteger('jour');
            $table->unsignedBigInteger('carte_id')->index('carte_evolutions_carte_id_foreign');
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
        Schema::dropIfExists('carte_evolutions');
    }
}
