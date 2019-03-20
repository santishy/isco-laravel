<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::Create([
          "name" => "Admin",
          "slug" => "admin",
          "special" => "all-access"
        ]);
    }
}
