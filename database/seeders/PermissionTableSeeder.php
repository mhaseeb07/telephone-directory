<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['permission-group-list',1],
            ['permission-group-create',1],
            ['permission-group-edit',1],
            ['permission-group-delete',1],
            ['permission-list',1],
            ['permission-create',1],
            ['permission-edit',1],
            ['permission-delete',1],
            ['role-list',2],
            ['role-create',2],
            ['role-edit',2],
            ['role-delete',2],
            ['user-list',2],
            ['user-create',2],
            ['user-edit',2],
            ['user-delete',2],
            ['dashboard',2],
            ['department-create',2],
            ['department-edit',2],
            ['department-delete',2],
            ['department-softdelete',2],
            ['department-restore',2],
            ['contact-info-list',2],
            ['contact-info-create',2],
            ['contact-info-edit',2],
            ['contact-info-delete',2],
            ['contact-info-softdelete',2],
            ['contact-info-restore',2],
            ['category-create',2],
            ['category-edit',2],
            ['category-delete',2],
            ['category-softdelete',2],
            ['category-restore',2],
            ['reminder-list',2],
            ['reminder-create',2],
            ['reminder-edit',2],
            ['reminder-delete',2],
            ['reminder-softdelete',2],
            ['reminder-restore',2],
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['0'],'group_id'=>$permission[1]]);
        }
    }
}
