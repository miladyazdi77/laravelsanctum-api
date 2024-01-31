<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;


class PermissionService
{   /**
     * Get all permissions.
     *
     * @return Collection
     */
    public function getAllPermissions(): Collection
{
    return Permission::all();
}

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data): Permission
{
    return Permission::create($data);
}

    /**
     * Get a permission by ID.
     *
     * @param int $id
     * @return Permission
     */
    public function getPermissionById(int $id): Permission
{
    return Permission::findOrFail($id);
}

    /**
     * Update a permission.
     *
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function updatePermission(int $id, array $data): Permission
{
    $permission = Permission::findOrFail($id);
    $permission->update($data);
    return $permission;
}

    /**
     * Delete a permission.
     *
     * @param int $id
     * @return void
     */
    public function deletePermission(int $id): void
{
    $permission = Permission::findOrFail($id);
    $permission->delete();
}

}
