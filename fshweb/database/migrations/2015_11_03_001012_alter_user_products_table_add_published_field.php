<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProductsTableAddPublishedField extends Migration
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
            $table->boolean('published')->default('0')->after('pos_pdf');
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
            $table->dropColumn('published');
        });
    }
}
