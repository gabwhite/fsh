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

        // Role for admin
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);


        DB::table('users')->insert([
            'name' => 'breen',
            'email' => 'breen.young@gmail.com',
            'password' => bcrypt('password11')
        ]);

        // Role for breen
        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'usertest',
            'email' => 'user@user.com',
            'password' => bcrypt('password11')
        ]);

        // Role for usertest
        DB::table('role_user')->insert([
            'user_id' => 3,
            'role_id' => 3
        ]);

        DB::table('users')->insert([
            'name' => 'vendortest',
            'email' => 'vendor@vendor.com',
            'password' => bcrypt('password11')
        ]);

        // Role for vendortest
        DB::table('role_user')->insert([
            'user_id' => 4,
            'role_id' => 2
        ]);


    }
}
