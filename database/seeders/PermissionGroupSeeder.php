<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Developer',
            'Admin',
        ];
        foreach ($permissions as $permission) {
            PermissionGroup::create(['name' => $permission]);
        }
    }
}
