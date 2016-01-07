<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAllergensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_allergens', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('product_id')->unsigned();
            $table->integer('allergen_id')->unsigned();
            $table->timestamps();

            $table->primary(['product_id', 'allergen_id']);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::drop('product_allergens');
    }
}
