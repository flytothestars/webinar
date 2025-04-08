<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webinar;
use App\Enums\StatusEnum;

class StreamController extends Controller
{
    public function index($webinar_id)
    {
        $status = Webinar::where('uuid', $webinar_id)->pluck('status')->first();
        if($status == StatusEnum::PUBLISHED->value){
            return view('index', ['webinar_id' => $webinar_id]);
        }

        return response()->view('errors.404', [], 404);    }
}
