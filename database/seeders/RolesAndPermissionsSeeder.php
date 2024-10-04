<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'upload documents',
            'edit documents',
            'delete documents',
            'view documents',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'internal',
            'external',
        ];

        foreach ($roles as $role) {
            $roleInstance = Role::firstOrCreate(['name' => $role]);

            if ($role === 'internal') {
                $roleInstance->givePermissionTo(['upload documents', 'edit documents', 'delete documents']);
            } elseif ($role === 'external') {
                $roleInstance->givePermissionTo('view documents');
            }
        }

        $this->assignRoleToUser(1, 'internal');
        $this->assignRoleToUser(2, 'external');
    }

    private function assignRoleToUser($userId, $roleName)
    {
        $user = User::find($userId);

        if ($user) {
            $user->assignRole($roleName);
            return "Role assigned successfully.";
        }

        return "User not found.";
    }
}

