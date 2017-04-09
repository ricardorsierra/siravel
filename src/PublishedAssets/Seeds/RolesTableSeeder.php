<?php

use Illuminate\Database\Seeder;
use Sitec\Siravel\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->delete();

        Role::create([
            'name'   => 'user'
        ]);

        Role::create([
            'name'   => 'administrator'
        ]);



        if (!Role::where('name', 'member')->first()) {
            Role::create([
                'name' => 'member',
                'label' => 'Member',
                'permissions' => 'regular',
            ]);
            Role::create([
                'name' => 'admin',
                'label' => 'Admin',
                'permissions' => 'admin,sicms,regular',
            ]);
            Role::create([
                'name' => 'sicms',
                'label' => 'Sicms',
                'permissions' => 'sicms,regular',
            ]);
        }
    }
}
