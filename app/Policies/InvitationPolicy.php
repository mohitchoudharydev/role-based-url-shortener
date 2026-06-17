<?php

namespace App\Policies;

use App\Models\User;

class InvitationPolicy
{
    /**
     * Can access invitation creation.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [
            'SuperAdmin',
            'Admin'
        ]);
    }

    /**
     * Can send invitation for selected role.
     */
    public function invite(User $user, string $role): bool
    {
        if ($user->role === 'SuperAdmin') {
            return $role === 'Admin';
        }

        if ($user->role === 'Admin') {
            return in_array($role, [
                'Admin',
                'Member'
            ]);
        }

        return false;
    }
}