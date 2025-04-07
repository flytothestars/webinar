<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function index($webinar_id)
    {
        return view('index', ['webinar_id' => $webinar_id]);
    }
}
