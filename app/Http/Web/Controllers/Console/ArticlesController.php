<?php

namespace App\Http\Web\Controllers\Console;

use App\Http\Web\Controllers\FrontEnd\Controller;
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
}
