<?php

use App\Documentation;
use App\Patient;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'admin' => [
                'email' => 'admin@example.com',
                'password' => 'admin',
                'roles' => ['admin'],
            ],
        ];

        foreach ($users as $userName => $userData) {
            $user = new User();
            $user->name = $userName;
            $user->email = $userData['email'];
            $user->password = Hash::make($userData['password']);
            $user->save();
            foreach ($userData['roles'] as $userRoleName) {
                $user->roles()->attach(Role::where('name', $userRoleName)->first()->id);
            }
        }
    }
}
