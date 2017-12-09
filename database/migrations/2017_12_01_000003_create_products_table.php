<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->unsigned();
            $table->integer('market')->unsigned();
            $table->date('date');
            $table->string('name');
            $table->double('price');
            $table->double('discount');
            $table->double('new_price');
            $table->string('unit');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('market')->references('id')->on('markets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
