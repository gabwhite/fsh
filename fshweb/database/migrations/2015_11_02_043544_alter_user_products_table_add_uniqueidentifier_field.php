<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProductsTableAddUniqueidentifierField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_products', function(Blueprint $table)
        {
            $table->string('uniquekey', 200)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_products', function(Blueprint $table)
        {
            $table->dropColumn('uniquekey');
        });
    }
}
