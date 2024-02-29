@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h1>Create Category</h1>

        <!-- route store untuk melakukan penambahan data -->
        <form action="{{ route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="col-12">
                <label for="inputName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="inputName" name="name">
            </div>
            <div class="col-12">
                <label for="inputImage" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="inputImage" name="image">
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection