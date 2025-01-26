<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewDashboard(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
