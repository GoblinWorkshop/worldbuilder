<?php

namespace App\Http\Controllers;

use App\Article;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:255'
        ]);
        $article = new Article();
        $article->name = $request->input('name');
        $article->content = $request->input('content');
        if (!empty($request->file('filename'))) {
            $article->filename = $request->file('filename')->store('public/articles');
        }
        $article->save();
        return redirect('/articles');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)
            ->first();
        $article->name = $request->input('name');
        $article->content = $request->input('content');
        if (!empty($request->file('filename'))) {
            if ($article->filename !== '') {
                Storage::delete($article->filename);
            }
            $article->filename = $request->file('filename')->store('public/articles');
        }
        $article->save();
        return redirect('/articles');
    }
}
