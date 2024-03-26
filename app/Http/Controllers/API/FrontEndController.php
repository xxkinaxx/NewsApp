<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;

class FrontEndController extends Controller
{
    public function index() {
        // get carousel from news
    try {
        // get carousel
        $slider = News::latest()->limit(5)->get();

        return ResponseFormatter::success(
            $slider, 'Slider data obtained'
        );
    } catch (\Exception $error) {
        return ResponseFormatter::error([
            'message' => 'something went wrong',
            'error' => $error
        ], 'Authentication Failed', 500);
    }
    }
}
