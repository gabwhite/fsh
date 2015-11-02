<?php

use Illuminate\Database\Seeder;

class AllergenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergens')->insert([
            'name' => 'Eggs'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Fish'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Gluten'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Lactose'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Milk'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Peanuts'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Shellfish'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Soy'
        ]);

        DB::table('allergens')->insert([
            'name' => 'Tree Nuts'
        ]);

    }
}
