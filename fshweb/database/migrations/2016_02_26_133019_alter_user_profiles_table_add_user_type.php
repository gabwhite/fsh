<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProfilesTableAddUserType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function ($table)
        {
            $table->integer('user_type_id')->unsigned()->nullable()->after('avatar_image_path');

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function ($table)
        {
            $table->dropColumn('user_type_id');
            $table->dropForeign('user_profiles_user_type_id_foreign');
        });
    }
}
