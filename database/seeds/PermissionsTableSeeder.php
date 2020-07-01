<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'api_user' => [
                'users' => [
                    'create user' => 'enable user to create users',
                    'view any user' => 'enable user to view any user',
                    'view user' => 'enable user to view user',
                    'edit user' => 'enable user to edit users',
                    'delete user' => 'enable user to delete users',
                ],
                'roles' => [
                    'create role' => 'enable user to create role',
                    'view roles' => 'enable user to view roles',
                    'edit roles' => 'enable users to edit roles',
                    'delete roles' => 'enable users to delete roles',
                ]
            ],
        ];

        foreach ($permissions as $guardName => $groups){
            foreach ($groups as $groupName => $names ){
                foreach ($names as $name => $description){
                    $permissions = new Permission();
                    $permissions->name = $name;
                    $permissions->guard_name = $guardName;
                    $permissions->group_name = $groupName;
                    $permissions->description = $description;
                    $permissions->save();
                }
            }
        }

    }
}