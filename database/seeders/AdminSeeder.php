<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            'type' =>  User::TYPE_ADMIN,
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
        $user->assignRole($role);

    }
}