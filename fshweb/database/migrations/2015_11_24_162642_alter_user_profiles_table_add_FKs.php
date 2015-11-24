<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProfilesTableAddFKs extends Migration
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
        Schema::table('user_profiles', function (Blueprint $table)
        {
            $table->dropForeign('user_profiles_country_foreign');
            $table->dropForeign('user_profiles_state_province_foreign');
        });
    }
}
