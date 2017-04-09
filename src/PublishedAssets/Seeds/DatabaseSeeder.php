<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(CMSSeeder::class);

        Model::reguard();
    }
}
