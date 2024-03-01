<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkCreate extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $link = $request->user()->links()->create([
            'url' => $request->input('url'),
        ]);

        return redirect()->back()->with('success', "Link Created: {$link->short_url}");
    }
}
