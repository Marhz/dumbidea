<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, $comment)
    {
        return $user->id == $comment->user_id;
    }
}
