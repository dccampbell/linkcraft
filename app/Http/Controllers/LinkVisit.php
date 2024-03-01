<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkVisit extends Controller
{
    public function __invoke(Request $request)
    {
        $link = Link::where('slug', $request->slug)->first();
        if (! $link) {
            abort(404);
        }
        $link->visit();
        return redirect($link->url);
    }
}
