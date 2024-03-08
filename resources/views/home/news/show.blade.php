@extends('home.parent')

@section('content')

<div class="ro">
    <div class="card p-4">
        <h1>{{ $news->title }} - <span class="badge rounded rounded-pill bg-info"> {{ $news->category->name }} </span></h1>
        <hr>
        <img src="{{ $news->image }}" alt="" class="container-fluid">
        <div class="mb-3">
                <textarea id="editor" disabled>
                    {!! $news->content !!}
                </textarea>
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
    </div>
</div>

@endsection