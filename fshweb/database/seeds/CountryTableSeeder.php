<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name' => 'Canada',
            'active' => 1
        ]);

        DB::table('countries')->insert([
            'name' => 'USA',
            'active' => 1
        ]);

    }
}
