<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\RolePermission;

class PostPolicy
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
     * Determine whether the user have access to this section.
     */
    public function index(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'index', $post_type_id);
    }

    /**
     * Determine whether the user can view the model (own content).
     */
    public function view(User $user, Post $post, $post_type_id): bool
    {
        return (RolePermission::check_permission($user->role, 'viewAny', $post_type_id)) || (RolePermission::check_permission($user->role, 'view', $post_type_id) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can view the model (any content).
     */
    public function viewAny(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'viewAny', $post_type_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'create', $post_type_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post, $post_type_id): bool
    {
        return (RolePermission::check_permission($user->role, 'updateAny', $post_type_id)) || (RolePermission::check_permission($user->role, 'update', $post_type_id) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateAny(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'updateAny', $post_type_id);
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post, $post_type_id): bool
    {
        return (RolePermission::check_permission($user->role, 'deleteAny', $post_type_id)) || (RolePermission::check_permission($user->role, 'delete', $post_type_id) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function deleteAny(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'update', $post_type_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function publish(User $user, Post $post, $post_type_id): bool
    {
        return (RolePermission::check_permission($user->role, 'publishAny', $post_type_id)) || (RolePermission::check_permission($user->role, 'publish', $post_type_id) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function publishAny(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'publishAny', $post_type_id);
    }

    /**
     * Determine whether the user can update their own published post.
     */
    public function update_published(User $user, Post $post, $post_type_id): bool
    {
        return (RolePermission::check_permission($user->role, 'updateAny_published', $post_type_id)) || (RolePermission::check_permission($user->role, 'update_published', $post_type_id) && $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can update any published post.
     */
    public function updateAny_published(User $user, $post_type_id): bool
    {
        return RolePermission::check_permission($user->role, 'updateAny_published', $post_type_id);
    }
}
