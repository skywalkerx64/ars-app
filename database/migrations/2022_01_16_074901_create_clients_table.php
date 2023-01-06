<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('contact');
            $table->string('region');
            $table->string('age');
            $table->unsignedBigInteger('agent_id')->index('clients_agent_id_foreign');
            $table->unsignedBigInteger('agence_id')->index('clients_agence_id_foreign');
            $table->string('tag');
            $table->unsignedInteger('carte_count')->default('1');
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
        Schema::dropIfExists('clients');
    }
}
