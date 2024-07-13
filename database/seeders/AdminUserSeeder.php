<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define Permissions
        $permissions = [
            'user.index',
            'user.create',
            'user.store',
            'user.edit',
            'user.update',
            'user.destroy',
            'role.index',
            'role.create',
            'role.store',
            'role.edit',
            'role.update',
            'role.destroy',
            'role.getRoutesAllJson',
            'role.getRefreshAndDeleteJson',
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Admin Role
        $adminRole = Role::create(['name' => 'Admin']);

        // Assign Permissions to Admin Role
        foreach ($permissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }

        // Create Admin User
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assign Admin Role to Admin User
        $adminUser->assignRole($adminRole);
    }
}