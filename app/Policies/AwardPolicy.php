<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AwardPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        $lastAward = $user->awards()->latest()->first();
        return $lastAward ? ! $lastAward->wasCreatedToday() : true;
    }
}
