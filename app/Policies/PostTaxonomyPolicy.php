<?php

namespace App\Policies;

use App\Models\PostTaxonomy;
use App\Models\User;
use App\Models\RolePermission;

class PostTaxonomyPolicy
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
     * Determine whether the user can create models.
     */
    public function create(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'create_taxonomy', $post_type_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'update_taxonomy', $post_type_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'delete_taxonomy', $post_type_id);
    }
}
