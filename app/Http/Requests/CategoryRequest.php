<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'image' => ['image', 'mimes:jpeg,png,jpg']
        ];
    }

    public function message(){
        return [
            'name.required' => 'Nama kategori wajib diisi',
            'image.image' => 'File yang diupload harus gambar',
            'image.mimes' => 'File yang diupload harus berformat jpeg, png, jpg',
        ];
    }
}
