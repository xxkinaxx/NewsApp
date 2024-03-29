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
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade">
                        <h1>{{ session('success') }}</h1>
                    </div>
                    @endif
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
                                <td class="d-flex gap-2">
                                    <!-- Basic Modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal{{ $row->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @include('home.category.includes.modal-show')

                                    <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- button delete with route category.destroy {{ $row->id }} -->
                                    <form action="{{ route('category.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <p>belum ada category, data masih kosong</p>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- pagination -->
                    {{ $category->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection