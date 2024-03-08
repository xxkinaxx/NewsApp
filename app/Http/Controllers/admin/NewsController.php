<?php

namespace App\Http\Controllers\admin;

use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'News - Index';
        // get data terbaru dari table news/ dari model news
        $news = News::latest()->paginate(5);
        $category = Category::all();
        return view('home.news.index', compact('title', 'news', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'News - Create';
        // model category
        $category = Category::all();
        return view('home.news.create', compact('title', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'content' => 'required'
        ]);

        //upload image
        $image = $request -> file('image');
        // fungsi untuk menyimpan image ke folser public/news, fungsi hashName() berfungsi untuk memberikan nama acak pada image
        $image->storeAs('public/news', $image->hashName());

        // create data ke dalam table
        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'image' => $image->hashName()
        ]);

        return redirect()->route('news.index')->with(['success', 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'News - show';
        $news = News::findOrFail($id);
        return view('home.news.show', compact('title', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'News - Edit';
        $news = News::findOrFail($id);
        $category = Category::all();
        return view('home.news.edit', compact('title', 'news', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
