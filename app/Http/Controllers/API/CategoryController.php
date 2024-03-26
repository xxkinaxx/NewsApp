<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index() {
        try {
            $category = Category::latest()->get();
            
            return ResponseFormatter::success(
                $category, 'Data Category Berhasil Diambil'
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
            $category = Category::findOrFail($id);

            return ResponseFormatter::success(
                $category, 'Data category by id'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function store(Request $request) {
        try{
            // validate
            $this->validate($request,[
                'name' => 'required|unique:categories',
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);

            // store image
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());

            // store data
            $category = Category::create([
                'name' =>$request->name,
                'slug' => Str::slug($request->name),
                'image' => $image->hashName()
            ]);

            return ResponseFormatter::success(
                $category, 'Data Category Berhasil Ditambahkan'
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
                'name' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg'
            ]);

            // get data category
            $category = Category::find($id);

            // store image
            if ($request->file('image') == '') {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                ]);
            } else {
                // jika gambar diupdate
                // hapus image lama
                Storage::disk('local')->delete('public/category/' . basename($category->image));
                //upload image baru
                $image = $request->file('image');
                $image->storeAs('public/category', $image->hashName());
                // update data
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $image->hashName()
                ]);
            }
            return ResponseFormatter::success($category, 'Data Category Berhasil Diubah');

        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function destroy($id) {
        try {
            // get date by id
            $category = Category::findOrFail($id);
            // delete image
            Storage::disk('local')->delete('public/category/' . basename($category->image));
            // delete data
            $category->delete();

            return ResponseFormatter::success(
                null, 'Data Category Berhasil Dihapus'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
