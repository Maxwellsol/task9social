<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\Versions\ARES;

class UserController extends Controller
{
    public function allUsers(){
        if(Auth::check())
        {
            $users = User::where('id', '!=', Auth::id())->get();
        }else{
            $users = User::all();
        }



        return view('user.users', ['users'=>$users]);
    }

    public function profile(Request $request, $id=null){
        $userID = null;
        if($id == null && Auth::check()){
            $userID = Auth::id();
        }else{
            $userID = $id;
        }

        $user = User::find($userID);
        $comments = $user->guestsComments()->where('parent_comment_id', null)->withTrashed();
        $commentsCount = $comments->count();

        if($request->all){
            return response()->json([
                'success' => true,
                'page'=> view('user.profile', ['user'=>$user, 'comments'=>$comments->get(), 'commentsCount'=>$commentsCount])->render(),
            ]);
        }


        $comments = $comments->take(5)->get();

        return view('user.profile', ['user'=>$user, 'comments'=>$comments, 'commentsCount'=>$commentsCount]);
    }
}
