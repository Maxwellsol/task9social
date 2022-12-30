<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;


class CommentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $comments = $user->userComments()->withTrashed();

        return view('comment.usercomments', ['comments'=>$comments->paginate(5)]);
    }
    public function store($userId, StoreCommentRequest $request)
    {

        $comment = new Comment();
        $data = $request->validated();
        $comment->title = $data['title'];
        $comment->text = $data['text'];
        $comment->user_id = Auth::id();
        $comment->recipient_id = $userId;
        $comment->parent_comment_id = (($data['parent_id']) ?? null );
        $comment->save();

        return Redirect::back();
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return Redirect::back();
    }

    public function restore($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $comment->restore();
        return Redirect::back();
    }


}
