<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RolePermission;

class UserPolicy
{
    /**
     * Admin have full access
     */
    public function before(User $user): bool|null
    {
        if ($user->role == 'admin') return true;

        return null;
    }


    /**
     * Determine whether the user can have access to see accounts area.
     */
    public function view(User $user): bool
    {
        return RolePermission::check_permission($user->role, 'view_users');
    }

    /**
     * Determine whether the user can create accounts.
     */
    public function create(User $user): bool
    {
        // Chech other permissions
        if (! RolePermission::check_permission($user->role, 'view_users')) return false;

        return RolePermission::check_permission($user->role, 'create_users');
    }

    /**
     * Determine whether the user can update accounts.
     */
    public function update(User $user): bool
    {
        // Chech other permissions
        if (! RolePermission::check_permission($user->role, 'view_users')) return false;

        return RolePermission::check_permission($user->role, 'update_users');
    }

    /**
     * Determine whether the user can delete accounts.
     */
    public function delete(User $user): bool
    {
        // Chech other permissions
        if (! RolePermission::check_permission($user->role, 'view_users')) return false;

        return RolePermission::check_permission($user->role, 'delete_users');
    }
}
