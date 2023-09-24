<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions=[
            'list_role','add_role','edit_role','delete_role',
        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }

    }
}
