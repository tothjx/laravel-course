<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('articles')
            ->orderBy('name')
            ->paginate(20);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['articles' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('users.show', compact('user'));
    }
}
