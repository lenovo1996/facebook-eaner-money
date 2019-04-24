<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function post()
    {
        $post = Post::orderBy('id', 'desc')->paginate(16);
        return view('admin.post', compact('post'));
    }

    public function comment()
    {
        $share = Comment::orderBy('id', 'desc')->paginate(16);
        return view('admin.comment', compact('share'));
    }

    public function savePost(Request $request)
    {
        $data = $request->only(['message', 'link', 'picture']);

        $result = Post::create($data);

        return response()->json([
            'result' => $result
        ]);
    }

    public function saveComment(Request $request)
    {
        $data = $request->only(['message']);

        $result = Comment::create($data);

        return response()->json([
            'result' => $result
        ]);
    }

    public function delComment($id)
    {
        Comment::find($id)->delete();
        return back();
    }

    public function delPost($id)
    {
        Post::find($id)->delete();
        return back();
    }
}
