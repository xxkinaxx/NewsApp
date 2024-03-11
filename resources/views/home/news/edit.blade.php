@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h1 class="text-center">Edit News</h1>

        <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="inputTitle" class="form-label">News Title</label>
                <input type="text" class="form-control" id="inputTitle" name="title" value="{{ $news->title }}">
            </div>

            <div class="mb-3">
                <label for="inputImage" class="form-label">News Image</label>
                <input type="file" class="form-control" id="inputImage" name="image" value="{{ $news->image }}">
            </div>

            <div class="mb-3">
                <label class="col-sm-2 col-form-label">Select</label>
                <div>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        <option value="{{ $news->category->name }}" selected> {{ $news->category->name }} </option>
                        @foreach ($category as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputContent" class="form-label">News Content</label>
                <textarea id="editor" name="content">{!! $news->content !!}</textarea>
            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i>
                    Update News
                </button>
            </div>
        </form>
    </div>
</div>

@endsection