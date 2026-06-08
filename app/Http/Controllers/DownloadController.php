<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    public function downloadTor(Request $request)
    {
        Log::info('Tor download visited', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
        ]);

       // $torLink = "https://docs.google.com/document/d/1BBKtoUTa1Vygrq00tDYHxfc2IP6PxIcs/edit";
        $torLink = "https://docs.google.com/document/d/1bcMiEllkXxYuDUiY0N0Q2Nt_pyTWz-fmIKRo0kjQCFI/edit";
        // Convert the Google Doc link to a "copy" link
        if (str_contains($torLink, 'docs.google.com/document/d/')) {
            $torLink = preg_replace('/\/edit.*$/', '/copy', $torLink);
            if (!str_ends_with($torLink, '/copy')) {
                $torLink = rtrim($torLink, '/') . '/copy';
            }
        }

        return redirect($torLink);
    }
}
