@extends('home.parent')

@section('content')
<div class="row">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card p-4">
        <h2 class="card-title">All User <i class="bi bi-person-fill"></i></h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $row)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $row->name }} </td>
                    <td> {{ $row->email }} </td>
                    <td> {{ $row->role }} </td>
                    <td>
                        <!-- Basic Modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#basicModal{{$row->id}}">
                            Reset Password
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <div class="modal fade" id="basicModal{{$row->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Reset Password <strong>{{ $row->name }}</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Default password = <strong>123456</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('resetPassword', $row->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Basic Modal-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection