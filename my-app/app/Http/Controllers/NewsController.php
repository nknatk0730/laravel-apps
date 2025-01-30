<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // $articles = [];

        $keyword = $request->input('keyword');
        $articles = News::getNews($keyword);

        return view('news.index', [
            'articles' => $articles['articles'] ?? [],
            'keyword' => $keyword,
        ]);
    }
}
