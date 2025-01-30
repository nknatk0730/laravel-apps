<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class News extends Model
{
    public static function getNews($keyword = null)
    {
        $uri = 'https://newsapi.org/v2/top-headlines?country=us&apiKey=' . config('services.newsapi.key');

        if ($keyword) {
            $uri .= '&q=' . urlencode($keyword);
        }

        $response = Http::get($uri);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch news');
        }

        return $response->json();
    }

    public static function summarizeArticle($content)
    {
    }

    use HasFactory;

}
