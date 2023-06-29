<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization ; 

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
    public function update(User $user, Comment $comment): bool
    {
        if($user->id == $comment->user_id || $user->role_id == 2 ){
            return true;
        }
        else{
            return false;
        };
    } 

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if($user->id ==$comment->user_id || $user->id == $comment->post->user_id || $user->role_id == 2 ){
            return true;
        }
        else{
            return false;
        };
    }

 
}
