<?php

namespace App\Http\Controllers;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cache-elve 1 órára
        $articles = Cache::remember('articles_list', 3600, function () {
            return Article::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        });

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'lead' => $request->lead,
            'body' => $request->body,
        ]);

        // Cache törlése
        Cache::forget('articles_list');

        // Event kiváltása
        event(new ArticleCreated($article));

        return redirect()->route('articles.index')
            ->with('success', 'Cikk sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load('user');
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Csak a szerző vagy admin szerkesztheti
        if (auth()->user()->id !== $article->user_id && !auth()->user()->is_admin) {
            abort(403, 'Nincs jogosultságod ehhez a művelethez.');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update([
            'title' => $request->title,
            'lead' => $request->lead,
            'body' => $request->body,
        ]);

        // Cache törlése
        Cache::forget('articles_list');

        return redirect()->route('articles.show', $article)
            ->with('success', 'Cikk sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Csak admin törölhet
        if (!auth()->user()->is_admin) {
            abort(403, 'Nincs jogosultságod ehhez a művelethez.');
        }

        $article->delete();

        // Cache törlése
        Cache::forget('articles_list');

        return redirect()->route('articles.index')
            ->with('success', 'Cikk sikeresen törölve!');
    }
}
