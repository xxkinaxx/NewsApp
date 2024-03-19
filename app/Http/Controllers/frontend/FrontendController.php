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
        $sliderNews = News::latest()->limit(5)->get();
        // get data by category only
        $categoryNews = News::with('category')->latest()->get();

        return view('frontend.news.index', compact('title', 'category', 'sliderNews', 'categoryNews'));
    }
    public function detailNews($slug) {
        // get data category
        $category = Category::latest()->get();
        // get data news by slug
        $news = News::where('slug', $slug)->first();

        $sideNews = News::get();

        return view('frontend.news.detail', compact('category', 'news', 'sideNews'));
    }

    public function detailCategory($slug) {
        // get data category
        $category = Category::latest()->get();
        // get data category by slug
        $detailCategory = Category::where('slug', $slug)->first();
        // 
        $news = News::where('category_id', $detailCategory->id)->latest()->get();

        return view('frontend.news.detail-category', compact('category', 'detailCategory', 'news'));
    }
}
