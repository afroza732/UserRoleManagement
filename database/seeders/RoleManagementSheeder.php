<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleManagementSheeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //craete  Role
       $superRole = Role::create(['name' => 'superadmin']);
       $adminRole = Role::create(['name' => 'admin']);
       $editorRole = Role::create(['name' => 'editor']);
       $userRole = Role::create(['name' => 'user']);


       //Permission Array
       $permissions = [
           [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
           ],
           [
                'group_name' => 'blog',
                'permissions' => [
                    //Blog Permission
                        'blog.create',
                        'blog.view',
                        'blog.edit',
                        'blog.delete',
                        'blog.approve',

                    ]
            ],
          
            [
                'group_name' => 'admin',
                'permissions' => [
                     //Admin Permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',

                ]
            ],
           
            [
                'group_name' => 'role',
                'permissions' => [
                    //Role Permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',

                ]
            ],

             
              //Profile Permission

              [
                'group_name' => 'profile',
                'permissions' => [
                    'profile.create',
                    'profile.view',
                    'profile.edit',
                    'profile.delete',
                    'profile.approve',

                ]
            ],

       ];

       for ($i=0; $i < count($permissions) ; $i++) { 
        $group_name = $permissions[$i]['group_name'];
        for ($j=0; $j < count($permissions[$i]['permissions']); $j++) { 
            $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j] , 'group_name' =>  $group_name]);
            $superRole->givePermissionTo($permission);
            $permission->assignRole($superRole);
        }
       
       }
    }
}
