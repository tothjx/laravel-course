<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('guest.posts.index');
    }

    public function show($id)
    {
        $posts = config('blog.posts');
        $post = collect($posts)->firstWhere('id', (int)$id);

        if (!$post) {
            abort(404, 'Post nem található');
        }

        return view('guest.posts.show', compact('post'));
    }
}
