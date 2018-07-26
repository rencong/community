<?php

namespace App\Http\Controllers;

use App\Model\Discussion;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index()
    {
        $discussions = Discussion::all();
        return view('forum.index',compact('discussions'));
    }
}
