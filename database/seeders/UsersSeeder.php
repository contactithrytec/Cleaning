<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create([
            'username' => "ibra_dj",
            'first_name'=>'ibrahim',
            'last_name'=>'djama',
            'address'=>'boudraa salah city Constantine Algeria',
            'phone_number'=>'0676843178',
            'status'=>1,
            'role_name'=>['admin'],
            'email' => 'ibra.@gmail.com',
            'password' => Hash::make('123456'),
        ]);



        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id')->all();


        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);





    }
}
