<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laratrust\Models\LaratrustRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(
            [
            'first_name' => 'Admin',
            'last_name' => 'Defenzelite',
            'email' => 'admin@test.com',
            'phone' => '8085122017',
            'password' => bcrypt(1234),
            'email_verified_at' => now()
            ]
        );
        
        $user = User::firstOrCreate(
            [
            'first_name' => 'User',
            'last_name' => 'Defenzelite',
            'email' => 'user@test.com',
            'phone' => '0000000000',
            'password' => bcrypt(1234),
            'email_verified_at' => now()
            ]
        );

        $admin->syncRoles([LaratrustRole::where('name', 'admin')->first()]);
        $user->syncRoles([LaratrustRole::where('name', 'user')->first()]);
    }
}
