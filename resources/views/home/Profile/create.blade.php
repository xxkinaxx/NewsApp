@extends('home.parent')

@section('content')
<div class="row">
    <div class="card p-4">
        <h1>Create Profile {{ Auth::user()->name }}</h1>
        <form action="{{ route('profile.store-profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row mb-3 mt-3">
                <label for="inputText" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="first_name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary">
                    <i class="bi bi-plus-l"></i>
                    Create Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection