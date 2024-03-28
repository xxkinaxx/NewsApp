<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index() {
        try {
            $news = News::latest()->get();
            return ResponseFormatter::success(
                $news, 'Data list of news'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function show($id) {
        try {
            // get data by id
            $news = News::findOrFail($id);

            return ResponseFormatter::success(
                $news, 'Data news by id'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function store(Request $request) {
        try {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg',
                'content' => 'required'
            ]);

            // upload image
            $image = $request->file('image');
            $image->storeAs('public/news', $image->hashName());

            // create data
            $news = News::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_id' => $request->category_id,
                'content' => $request->content,
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success(
                $news, 'Data News has been Created'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function destroy($id) {
        try {
            // get data by id
            $news = News::findOrFail($id);

            // delete image
            Storage::disk('local')->delete('public/news' . basename($news->image));

            // delete data
            $news->delete();

            return ResponseFormatter::success(
                null, 'Data news already Deleted'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            // validate
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg',
                'content' => 'required'
            ]);

            // get data by id
            $news = News::findOrFail($id);

            if($request->file('image') == '') {
                // update data
            $news->update([
                'title' => $request->title,
                'categoty_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->title)
            ]);
            } else {
                // hapus image lama
                Storage::disk('local')->delete('public/news/'.basename($news->image));
                // upload image baru
                $image = $request->file('image');
                $image -> storeAs('public/news', $image->hashName());
                // update data
                $news->update([
                    'title' => $request->title,
                    'categoty_id' => $request->category_id,
                    'content' => $request->content,
                    'image' => $image->hashName(),
                    'slug' => Str::slug($request->title)
                ]);
            }

            return ResponseFormatter::success([
                'news' => $news,
                'message' => 'News already Updated'
            ], 'Authenticated', 500);
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
