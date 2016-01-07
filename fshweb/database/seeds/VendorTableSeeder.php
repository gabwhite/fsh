<?php

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert([
            'user_id' => 4,
            'company_name' => 'Foodservicehound.com'
        ]);
    }
}
