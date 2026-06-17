<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ShortUrl;

class ShortUrlPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ShortUrl $url): bool
    {
        if ($user->role === 'SuperAdmin') {
            return true;
        }

        if ($user->role === 'Admin') {
            return $user->company_id === $url->company_id;
        }

        if ($user->role === 'Member') {
            return $user->id === $url->user_id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array(
            $user->role,
            ['Admin', 'Member']
        );
    }
}