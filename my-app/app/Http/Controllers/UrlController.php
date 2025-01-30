<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index()
    {
        return view('urls.index');
    }

    public static function store(Request $request)
    {
        $validated = $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortUrl = substr(md5($validated['original_url']).time(), 0, 8);

        Url::create([
            'original_url' => $request->original_url,
            'short_url' => $shortUrl,
            'expired_at' => Carbon::now()->addDay(config('app.url_expiration_days')),
        ]);

        return response()->json(['short_url' => url($shortUrl)]);
    }

    public function redirect($shortUrl)
    {
        // $url = Url::where('short_url', $shortUrl)->first();
        // if (empty($url)) {
        //     abort(404);
        // }

        // if ($url->expired_at->lt(Carbon::now())) {
        //     abort(404);
        // }
        // if (!$url | $url->expired_at->isPast()) {
        //     // abort(404);
        //     return response()->view('urls.errors.404', 404);
        // }
        return redirect('/urls');
    }
}
