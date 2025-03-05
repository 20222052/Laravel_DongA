<?php

namespace App\Policies;

use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function read(User $user) {
        return $user->id == 1 || $user->id == 2;
    }

    public function edit(User $user) {
        return $user->id == 1;
    }
}
