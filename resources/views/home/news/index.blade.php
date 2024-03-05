@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h1>News Index</h1>

        <div class="d-flex justify-content-end">
            <a href="{{ route('news.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Create News
            </a>
        </div>
    </div>
</div>

@endsection