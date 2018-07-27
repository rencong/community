<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        $this->validate($request, [
            'body'          => 'required',
            'discussion_id' => 'required'
        ]);

        Comment::create(array_merge($request->all(), ['user_id' => Auth::user()->id]));
        return redirect()->action('PostController@show', ['id' => $request->input('discussion_id')]);
    }
}
