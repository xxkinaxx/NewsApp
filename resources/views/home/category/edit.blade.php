@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h2>Category Update</h2>
        <hr>
        <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="inputName" name="name" value="{{ $category->name }}">
            </div>
            <div class="col-12">
                <label for="inputImage" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="inputImage" name="image">
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('category.index') }}" class="btn btn-primary me-2">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i>
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>

@endsection