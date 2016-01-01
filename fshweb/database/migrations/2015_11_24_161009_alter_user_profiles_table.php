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
            $table->string('logo_image_path', 200)->nullable()->after('vendor_id');
            $table->string('contact_phone', 200)->nullable()->after('vendor_id');
            $table->string('contact_name', 200)->nullable()->after('vendor_id');
            $table->string('zip_postal', 50)->nullable()->after('vendor_id');
            $table->string('city', 200)->nullable()->after('vendor_id');
            $table->integer('state_province')->unsigned()->nullable()->after('vendor_id');
            $table->integer('country')->unsigned()->nullable()->after('vendor_id');
            $table->string('address2', 200)->nullable()->after('vendor_id');
            $table->string('address1', 200)->nullable()->after('vendor_id');
            $table->string('company', 200)->nullable()->after('vendor_id');
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
            $table->dropColumn(['company', 'address1', 'address2', 'country', 'state_province', 'city', 'zip_postal', 'contact_name', 'contact_phone', 'logo_image_path']);
        });
    }
}
