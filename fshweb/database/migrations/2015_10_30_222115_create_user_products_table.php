<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';


            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 500);
            $table->text('description');

            $table->string('brand', 250)->nullable();
            $table->integer('pack')->unsigned()->nullable();
            $table->integer('calc_size')->unsigned()->nullable();
            $table->string('mpc', 250)->nullable();
            $table->string('broker_contact', 250)->nullable();
            $table->text('allergen_disclaimer')->nullable();
            $table->text('features_benefits')->nullable();
            $table->text('ingredient_deck')->nullable();
            $table->string('uom', 250)->nullable();
            $table->string('gtin', 250)->nullable();

            $table->integer('calories')->unsigned()->nullable();
            $table->integer('calories_from_fat')->unsigned()->nullable();
            $table->integer('saturated_fats')->unsigned()->nullable();
            $table->integer('total_fat')->unsigned()->nullable();
            $table->integer('sodium')->unsigned()->nullable();
            $table->integer('fibre')->unsigned()->nullable();
            $table->integer('sugar')->unsigned()->nullable();
            $table->integer('protein')->unsigned()->nullable();
            $table->integer('carbs')->unsigned()->nullable();

            $table->decimal('net_weight', 6, 2)->unsigned()->nullable();
            $table->decimal('gross_weight', 6 , 2)->unsigned()->nullable();
            $table->decimal('tare_weight', 6, 2)->unsigned()->nullable();

            $table->boolean('is_halal')->default('0');
            $table->boolean('is_organic')->default('0');
            $table->boolean('is_kosher')->default('0');
            $table->integer('serving_size')->unsigned()->nullable();
            $table->string('calculation_size_uom', 250)->nullable();
            $table->string('serving_size_uom', 250)->nullable();
            $table->text('preparation')->nullable();
            $table->decimal('size', 6, 2)->nullable();
            $table->string('vendor_logo', 500)->nullable();
            $table->string('product_image', 500)->nullable();
            $table->string('pos_pdf', 500)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_products');
    }
}
