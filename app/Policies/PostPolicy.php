<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // public function before(User $user): bool
    // {
    //     if ($user->role_id == 2) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->id == $post->user_id || $user->role_id == 2 ) {
            return true;
        } else {
            return false;
        };
    }
 
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->id == $post->user_id || $user->role_id == 2) {
            return true;
        } else {
            return false;
        };
    }
}
