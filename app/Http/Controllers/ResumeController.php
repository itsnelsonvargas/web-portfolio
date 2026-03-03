<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ResumeController extends Controller
{
    public function index(string $category): RedirectResponse
    {
        return match ($category) {
            'pm' => redirect()->away('https://www.canva.com/design/DAHCnxLewS4/EyKnMi8U7nZcZzGVDWTHww/edit?utm_content=DAHCnxLewS4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton'),

            'dev' => redirect()->away('https://www.canva.com/design/DAGtyKG958Y/KpGNkYhAltA6NPCv0UywLA/edit?utm_content=DAGtyKG958Y&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton'),

            default => abort(404),
        };
    }
}
