<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_type');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->longText('content');
            $table->string('image');  
            $table->float('unit_price');
            $table->float('promotion_price');
            $table->string('new');
            $table->integer('quantity');
            $table->foreign('id_type')->references('id')->on('product_types');
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
        Schema::dropIfExists('products');
    }
}
