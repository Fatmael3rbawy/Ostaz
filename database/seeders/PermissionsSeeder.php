<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // role
            [
                'name' => 'roles_index',
                'display_name' => 'access',
                'key' => 'roles'
            ],
            [
                'name' => 'roles_view',
                'display_name' => 'view',
                'key' => 'roles'
            ],
            [
                'name' => 'roles_create',
                'display_name' => 'create',
                'key' => 'roles'
            ],
            [
                'name' => 'roles_edit',
                'display_name' => 'edit',
                'key' => 'roles'
            ],
            [
                'name' => 'roles_delete',
                'display_name' => 'delete',
                'key' => 'roles'
            ],
            [
                'name' => 'roles_block',
                'display_name' => 'block',
                'key' => 'roles'
            ],

        

            // area
            [
                'name' => 'areas_index',
                'display_name' => 'access',
                'key' => 'areas'
            ],
            [
                'name' => 'areas_view',
                'display_name' => 'view',
                'key' => 'areas'
            ],
            [
                'name' => 'areas_create',
                'display_name' => 'create',
                'key' => 'areas'
            ],
            [
                'name' => 'areas_edit',
                'display_name' => 'edit',
                'key' => 'areas'
            ],
            [
                'name' => 'areas_delete',
                'display_name' => 'delete',
                'key' => 'areas'
            ],
            [
                'name' => 'areas_block',
                'display_name' => 'block',
                'key' => 'areas'
            ],

            // main specialization

            [
                'name' => 'specializations_index',
                'display_name' => 'access',
                'key' => 'specializations'
            ],
            [
                'name' => 'specializations_view',
                'display_name' => 'view',
                'key' => 'specializations'
            ],
            [
                'name' => 'specializations_create',
                'display_name' => 'create',
                'key' => 'specializations'
            ],
            [
                'name' => 'specializations_edit',
                'display_name' => 'edit',
                'key' => 'specializations'
            ],
            [
                'name' => 'specializations_delete',
                'display_name' => 'delete',
                'key' => 'specializations'
            ],
            [
                'name' => 'specializations_block',
                'display_name' => 'block',
                'key' => 'specializations'
            ],

            // sub specialization

            [
                'name' => 'sub_specializations_index',
                'display_name' => 'access',
                'key' => 'sub_specializations'
            ],
            [
                'name' => 'sub_specializations_view',
                'display_name' => 'view',
                'key' => 'sub_specializations'
            ],
            [
                'name' => 'sub_specializations_create',
                'display_name' => 'create',
                'key' => 'sub_specializations'
            ],
            [
                'name' => 'sub_specializations_edit',
                'display_name' => 'edit',
                'key' => 'sub_specializations'
            ],
            [
                'name' => 'sub_specializations_delete',
                'display_name' => 'delete',
                'key' => 'sub_specializations'
            ],
            [
                'name' => 'sub_specializations_block',
                'display_name' => 'block',
                'key' => 'sub_specializations'
            ],


            // employee
            [
                'name' => 'employees_index',
                'display_name' => 'access',
                'key' => 'employees'
            ],
            [
                'name' => 'employees_view',
                'display_name' => 'view',
                'key' => 'employees'
            ],
            [
                'name' => 'employees_create',
                'display_name' => 'create',
                'key' => 'employees'
            ],
            [
                'name' => 'employees_edit',
                'display_name' => 'edit',
                'key' => 'employees'
            ],
            [
                'name' => 'employees_delete',
                'display_name' => 'delete',
                'key' => 'employees'
            ],
            [
                'name' => 'employees_block',
                'display_name' => 'block',
                'key' => 'employees'
            ],

            // method
            [
                'name' => 'methods_index',
                'display_name' => 'access',
                'key' => 'methods'
            ],
            [
                'name' => 'methods_view',
                'display_name' => 'view',
                'key' => 'methods'
            ],
            [
                'name' => 'methods_create',
                'display_name' => 'create',
                'key' => 'methods'
            ],
            [
                'name' => 'methods_edit',
                'display_name' => 'edit',
                'key' => 'methods'
            ],
            [
                'name' => 'methods_delete',
                'display_name' => 'delete',
                'key' => 'methods'
            ],
            [
                'name' => 'methods_block',
                'display_name' => 'block',
                'key' => 'methods'
            ],

            // app setting
            [
                'name' => 'app_settings_index',
                'display_name' => 'access',
                'key' => 'app_settings'
            ],
            [
                'name' => 'app_settings_edit',
                'display_name' => 'access',
                'key' => 'app_settings'
            ],

            // reports
            [
                'name' => 'reports_index',
                'display_name' => 'access',
                'key' => 'reports'
            ],

            // Instructor
            [
                'name' => 'instructor_index',
                'display_name' => 'index',
                'key' => 'instructors'
            ],
            [
                'name' => 'instructor_view',
                'display_name' => 'view',
                'key' => 'instructors'
            ],
            [
                'name' => 'instructor_add',
                'display_name' => 'add',
                'key' => 'instructors'
            ],
            [
                'name' => 'instructor_edit',
                'display_name' => 'edit',
                'key' => 'instructors'
            ],

            // user
            [
                'name' => 'user_index',
                'display_name' => 'index',
                'key' => 'users'
            ],
            [
                'name' => 'user_upgrade',
                'display_name' => 'upgrade',
                'key' => 'users'
            ],
            [
                'name' => 'user_block',
                'display_name' => 'block',
                'key' => 'users'
            ],

        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate($permission);
        }

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }

    }
}