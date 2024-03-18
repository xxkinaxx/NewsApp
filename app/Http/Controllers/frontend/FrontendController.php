<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $title = 'Home';
        $category = Category::latest()->get();
        // slider news content
        $sliderNews = News::latest()->limit(3)->get();
        // get data by category only
        $categoryNews = News::with('category')->latest()->get();

        return view('frontend.news.index', compact('title', 'category', 'sliderNews', 'categoryNews'));
    }
}
