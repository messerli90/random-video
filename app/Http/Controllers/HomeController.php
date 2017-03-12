<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $video = Video::getRandom();

        return view('index', compact('video'));
    }
}
