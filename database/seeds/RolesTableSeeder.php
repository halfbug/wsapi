<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "sadmin",
            'desc' => "master user having all permissions",
            
           ]);
        DB::table('roles')->insert([
            'name' => "admin",
            'desc' => "admin user having admin permissions",
            
        ]);
        DB::table('roles')->insert([
            'name' => "siteuser",
            'desc' => "registered users having site permissions",
            
        ]);
    }
}
