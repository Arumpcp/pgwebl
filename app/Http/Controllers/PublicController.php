<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(): View
    {
    $data = [
            'title' => "TjapTrans",
        ];

        return view('home',  $data);
    }
}
