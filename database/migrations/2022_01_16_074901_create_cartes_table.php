<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('cartes_client_id_foreign');
            $table->unsignedBigInteger('agent_id')->index('cartes_agent_id_foreign');
            $table->string('tag');
            $table->double('duree')->unsigned();
            $table->double('tranches')->unsigned();
            $table->double('cout')->unsigned();
            $table->double('pourcentage')->unsigned();
            $table->double('last_pay')->unsigned()->nullable();
            $table->double('last_big_pay')->unsigned()->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('LP')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('last_pay_date')->nullable();
            $table->timestamp('last_big_pay_date')->nullable();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('cartes');
    }
}
