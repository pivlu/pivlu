<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RolePermission;

class FormDataPolicy
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
     * Determine whether the user have access to view messages.
     */
    public function view_forms_messages(User $user): bool
    {
        return RolePermission::check_permission($user->role, 'view_forms_messages');
    }


    /**
     * Determine whether the user can delete the message.
     */
    public function delete_forms_messages(User $user): bool
    {
        return RolePermission::check_permission($user->role, 'delete_forms_messages');
    }

    /**
     * Determine whether the user can reply to the message.
     */
    public function reply_forms_messages(User $user): bool
    {
        return RolePermission::check_permission($user->role, 'reply_forms_messages');
    }
}
