<?php

namespace App\Http\Controllers;

use App\Model\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YuanChao\Editor\EndaEditor;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    }

    //
    public function index()
    {
        $discussions = Discussion::latest()->get();
        return view('forum.index', compact('discussions'));
    }

    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->body = EndaEditor::MarkDecode($discussion->body);

        return view('forum.show', compact('discussion'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'body'  => 'required',
            ]
        );

        $data = [
            'user_id'      => Auth::id(),
            'last_user_id' => Auth::id()
        ];
        $discussion = Discussion::create(array_merge($request->all(), $data));

        //action是重定向到控制器方法
        return redirect()->action('PostController@show', ['id' => $discussion->id]);
    }

    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        if (Auth::id() !== $discussion->user_id) {
            return redirect('/');
        }

        return view('forum.edit', compact('discussion'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'body'  => 'required',
                'id'    => 'required'
            ]
        );
        $discussion = Discussion::findOrFail($request->input('id'));

        $data = [
            'last_user_id' => Auth::id()
        ];
        $discussion->update(array_merge($request->all(), $data));

        //action是重定向到控制器方法
        return redirect()->action('PostController@show', ['id' => $discussion->id]);
    }

    /**
     * markdown编辑器
     * @return string
     */
    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
}
