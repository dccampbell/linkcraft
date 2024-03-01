<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkImport extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $filePath = $request->file('file')?->getPathname();
        if (! $filePath) {
            return redirect()->back()->withErrors(['file' => 'File Import Error']);
        }

        $csvData = file($filePath);
        foreach ($csvData as $line) {
            $url = trim($line);
            if ($url) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    $request->user()->links()->create([
                        'url' => $url,
                    ]);
                } else {
                    \Log::warning("Invalid URL: $url");
                    // @todo warn user of skipped URLs
                }
            }
        }

        return redirect()->back()->with('success', 'Import Successful');
    }
}
