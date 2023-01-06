<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule');
            $table->string('image')->default('product_default.png');
            $table->mediumText('description');
            $table->double('prix')->unsigned()->default(0);
            $table->double('prix_2')->unsigned()->default(0);
            $table->double('pourcentage')->unsigned()->default(0);
            $table->double('pourcentage_2')->unsigned()->default(0);
            $table->string('categorie');
            $table->string('tag');
            $table->unsignedBigInteger('change_price_count')->default('0');
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
        Schema::dropIfExists('produits');
    }
}
