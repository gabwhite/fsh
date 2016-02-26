<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'name' => 'Assistant Kitchen Manager'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Broker'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Chef'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Cook'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Distributor'
        ]);

        DB::table('user_types')->insert([
            'name' => 'F&B Manager'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Assistant F&B Manager'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Kitchen Manager'
        ]);

        DB::table('user_types')->insert([
            'name' => 'Student'
        ]);

    }
}
