<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('caisse_id')->index('transactions_caisse_id_foreign');
            $table->unsignedBigInteger('carte_id')->nullable()->index('transactions_carte_id_foreign');
            $table->double('montant')->unsigned();
            $table->string('motif');
            $table->enum('statut', ['Retrait', 'Depot'])->default('Depot');
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
        Schema::dropIfExists('transactions');
    }
}
