<?php

use Sitec\Siravel\Models\User;
use Sitec\Siravel\Services\UserService;
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
        $service = app(UserService::class);
        DB::table('users')->delete();

        $adminRole = Role::whereName('administrator')->first();
        $user = User::create(array(
            'first_name'    => 'Sierra',
            'last_name'     => 'Tecnologia',
            'email'         => 'simaster@sierratecnologia.com.br',
            'password'      => Hash::make('123456'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($adminRole);

        $userRole = Role::whereName('user')->first();
        $user = User::create(array(
            'first_name'    => 'Sierra',
            'last_name'     => 'Tecnologia',
            'email'         => 'clientes@sierratecnologia.com.br',
            'password'      => Hash::make('123456'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($userRole);
        
        if (!User::where('name', 'admin')->first()) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ]);
            
            $service->create($user, 'admin', 'admin', false);
        }

    }
}
