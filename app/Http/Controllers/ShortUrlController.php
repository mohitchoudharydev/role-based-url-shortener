<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();


    $urls = ShortUrl::visibleTo(auth()->user())
        ->with('user')
        ->get();

        return view('urls.index', compact('urls'));
    }

    public function create()
    {
        $user = auth()->user();

        $this->authorize('create', ShortUrl::class);


        return view('urls.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

    $this->authorize('create', ShortUrl::class);


        $request->validate([
            'original_url' => ['required', 'url']
        ]);

        ShortUrl::create([
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'short_code' => $this->generateCode(),
        ]);

        return redirect()
            ->route('urls.index')
            ->with('success', 'URL created successfully');
    }

    public function redirect($code)
    {
        $url = ShortUrl::where(
            'short_code',
            $code
        )->firstOrFail();
        return redirect($url->original_url);
    }

    private function generateCode()
    {
        do {

            $code = str()->random(6);

        } while (
            ShortUrl::where(
                'short_code',
                $code
            )->exists()
        );

        return $code;
    }
}