<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=============================================
        // Setup roles
        //=============================================

        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'vendor'
        ]);

        DB::table('roles')->insert([
            'name' => 'user'
        ]);

        //=============================================
        // Setup permissions
        //=============================================

        DB::table('permissions')->insert([
            'name' => 'import-products',
            'display_name' => 'Import Products',
            'description' => 'Use the admin import tool'
        ]);

        DB::table('permissions')->insert([
            'name' => 'public-view-products',
            'display_name' => 'View Products (Public)',
            'description' => 'Able to view products on public site'
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete-own-product',
            'display_name' => 'Delete Owned Products',
            'description' => 'Able to delete owned products'
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit-own-product',
            'display_name' => 'Edit Owned Product',
            'description' => 'Able to edit products you own'
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit-any-product',
            'display_name' => 'Edit Any Product',
            'description' => 'Edit any product regardless of owner'
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete-any-product',
            'display_name' => 'Delete Any Product',
            'description' => 'Able to delete any product'
        ]);

        //=============================================
        // Setup permissions role relations
        //=============================================

        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 5,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 6,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 2
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 3,
            'role_id' => 2
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 4,
            'role_id' => 2
        ]);
    }
}
