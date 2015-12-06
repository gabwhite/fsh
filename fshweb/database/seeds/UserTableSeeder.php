<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password11')
        ]);

        DB::table('users')->insert([
            'name' => 'breen',
            'email' => 'breen.young@gmail.com',
            'password' => bcrypt('password11')
        ]);

        DB::table('users')->insert([
            'name' => 'usertest',
            'email' => 'user@user.com',
            'password' => bcrypt('password11')
        ]);

        DB::table('users')->insert([
            'name' => 'vendortest',
            'email' => 'vendor@vendor.com',
            'password' => bcrypt('password11')
        ]);


    }
}
