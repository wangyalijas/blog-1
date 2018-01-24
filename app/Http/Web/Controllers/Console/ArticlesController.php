<?php

namespace App\Http\Web\Controllers\Console;

use App\Http\Web\Controllers\FrontEnd\Controller;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('console.articles.home');
    }
}
