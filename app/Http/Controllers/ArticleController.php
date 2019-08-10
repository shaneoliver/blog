<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'excerpt' => 'nullable|max:255',
            'slug' => 'required|unique:articles,slug',
            'password' => 'nullable',
            'private' => 'nullable',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'user_id' => Auth::user()->id,
            'slug' => $request->slug,
            'password' => $request->password,
            'private' => $request->private,
            'published_at' => \Carbon\Carbon::now(),
        ]);
        
        if($request->wantsJson()) {
            return $article;
        }
        
        return redirect(route('articles.show', $article->id));      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $this->authorize('view', $article);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:articles,slug',
            'password' => 'nullable',
            'private' => 'nullable',
        ]);

        $article->update($attributes);

        return redirect(route('articles.show', $article->id));      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return redirect(route('articles.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
