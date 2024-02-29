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
                            <!-- menampilkan data dengan perulangan data dari category -->
                            @forelse ($category as $row)
                            <tr>
                                <!-- numbering menggunakanl loop -->
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $row->name }} </td>
                                <td> {{ $row->slug }} </td>
                                <td>
                                    <img src="{{ $row->image }}" width="200px" class="rounded" alt="">
                                </td>
                                <td>
                                    <!-- Basic Modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal{{ $row->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="modal fade" id="basicModal{{ $row->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Category Name: <strong class="text-uppercase fw-vold"> {{ $row->name }} </strong></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <img src="{{ $row->image }}" alt="" class="img-thumbnail">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Basic Modal-->
                                </td>
                            </tr>
                            @empty
                            <p>belum ada category, data masih kosong</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection