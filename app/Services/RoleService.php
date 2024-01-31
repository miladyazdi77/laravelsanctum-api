<?php

namespace App\Services;

use Spatie\Permission\Models\Role;


class RoleService
{
    public function createRole(string $name): Role
    {
        return Role::create(['name' => $name]);
    }

    public function updateRole(Role $role, string $name): void
    {
        $role->update(['name' => $name]);


    }

    public function deleteRole(Role $role): void
    {
        $role->delete();
    }

    // Add more methods as needed...
}
