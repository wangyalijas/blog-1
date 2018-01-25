<?php

namespace App\Http\Web\Controllers\Console;

use App\Http\Web\Controllers\FrontEnd\Controller;
use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Show hone page of the articles module on console.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('console.articles.home');
    }

    /**
     * Show new article page of the articles module on console.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('console.articles.editor');
    }

    /**
     * Show edit article page of the articles module on console.
     *
     * @param $id int Article ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $articleExists = Article::whereKey($id)->exists();
        if (!$articleExists) {
            throw (new ModelNotFoundException)->setModel(
                Article::class, $id
            );
        }

        return view('console.articles.editor', compact('id'));
    }
}
