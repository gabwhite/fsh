<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products_allergens', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('product_id')->unsigned();
            $table->integer('allergen_id')->unsigned();

            $table->primary(['product_id', 'allergen_id']);

            $table->foreign('product_id')->references('id')->on('user_products')->onDelete('cascade');
            $table->foreign('allergen_id')->references('id')->on('allergens')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_products_allergens');
    }
}
