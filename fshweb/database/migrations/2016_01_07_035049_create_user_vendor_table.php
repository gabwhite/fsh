<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vendor', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('user_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->timestamps();

            $table->primary(['user_id', 'vendor_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_vendor');
    }
}
