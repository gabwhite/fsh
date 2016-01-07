<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->string('company_name', 200);
            $table->string('address1', 200)->nullable();
            $table->string('address2', 200)->nullable();
            $table->string('city', 200)->nullable();
            $table->integer('state_province')->unsigned()->nullable();
            $table->integer('country')->unsigned()->nullable();
            $table->string('zip_postal', 50)->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('contact_title', 200)->nullable();
            $table->string('contact_phone', 200)->nullable();
            $table->string('contact_url', 200)->nullable();
            $table->string('intro_text', 1000)->nullable();
            $table->string('about_text', 1000)->nullable();
            $table->string('logo_image_path', 200)->nullable();
            $table->string('background_image_path', 200)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('countries');
            $table->foreign('state_province')->references('id')->on('stateprovinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function (Blueprint $table)
        {
            $table->dropForeign('vendors_user_id_foreign');
            $table->dropForeign('vendors_country_foreign');
            $table->dropForeign('vendors_state_province_foreign');
        });

        Schema::drop('vendors');

    }
}
