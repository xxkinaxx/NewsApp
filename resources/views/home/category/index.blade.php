@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h3>Category</h3>

        <div class="d-flex justify-content-end">
            <a href="  {{ route('category.create') }} " class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Create Category
            </a>
        </div>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Table</h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><b>N</b>ame</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kaskus</td>
                                <td>Kaskus</td>
                                <td>Gambar</td>
                                <td>
                                    <a href="#" class="btn btn-info">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button action="" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection