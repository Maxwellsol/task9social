<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function addComment(User $currentUser)
    {
        if(isset($currentUser)){
            return Response::allow();
        }
        return Response::deny();
    }

    public function replyComment(User $currentUser, Comment $comment)
    {
        if ($comment->user_id != $currentUser->id) {
            return Response::allow();
        }
        return Response::deny();
    }

    public function deleteComment(User $user, Comment $comment)
    {
        if ($comment->parent() && $comment->parent()->recipient_id == $user->id || $comment->user_id == $user->id) {
            return Response::allow();
        }
        return Response::deny();
    }
}
