<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('user_id')->unsigned();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar_image_path', 200)->nullable();
            $table->timestamps();

            $table->primary('user_id');

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
        Schema::drop('user_profiles');
    }
}
