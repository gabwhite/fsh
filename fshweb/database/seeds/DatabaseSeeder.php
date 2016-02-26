<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AllergenTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateProvinceTableSeeder::class);

        $this->call(RolePermissionSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(VendorTableSeeder::class);

        $this->call(UserTypeTableSeeder::class);

        Model::reguard();
    }
}
