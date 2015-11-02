<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products_categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';


            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->primary(['product_id', 'category_id']);

            $table->foreign('product_id')->references('id')->on('user_products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('food_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_products_categories');
    }
}
