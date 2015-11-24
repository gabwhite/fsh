<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table)
        {
            $table->string('company', 200)->nullable();
            $table->integer('country')->unsigned()->nullable();
            $table->integer('state_province')->unsigned()->nullable();
            $table->string('city', 200)->nullable();
            $table->string('zip_postal', 50)->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('contact_phone', 200)->nullable();
            $table->string('logo_image_path', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table)
        {
            $table->dropColumn(['company', 'country', 'state_province', 'city', 'zip_postal', 'contact_name', 'contact_phone', 'logo_image_path']);
        });
    }
}
