<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index($category)
    {
        if( $category === 'pm') {
            // For project manager resume
            return redirect('https://www.canva.com/design/DAHCnxLewS4/EyKnMi8U7nZcZzGVDWTHww/edit?utm_content=DAHCnxLewS4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton');
       
        }else if( $category === 'dev') {
            // For developer resume
            return redirect('https://drive.google.com/drive/folders/1Q37Vv1HtMCmLBKvg0XG6WA1B7uvZQziW');
        }

        return "";
    }
}
