<?php

namespace App\Http\Controllers;

use App\Post;
use App\Share;
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

    public function share()
    {
        $share = Share::orderBy('id', 'desc')->paginate(16);
        return view('admin.share', compact('share'));
    }

    public function savePost(Request $request)
    {
        $data = $request->only(['message', 'link', 'picture']);

        $result = Post::create($data);

        return response()->json([
            'result' => $result
        ]);
    }

    public function saveShare(Request $request)
    {
        $data = $request->only(['message', 'link', 'picture']);

        $result = Share::create($data);

        return response()->json([
            'result' => $result
        ]);
    }

    public function delShare($id)
    {
        Share::find($id)->delete();
        return back();
    }

    public function delPost($id)
    {
        Post::find($id)->delete();
        return back();
    }
}
