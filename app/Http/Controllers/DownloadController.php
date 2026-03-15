<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadTor(Request $request)
    {
        $torLink = "https://docs.google.com/document/d/1BBKtoUTa1Vygrq00tDYHxfc2IP6PxIcs/edit";

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
