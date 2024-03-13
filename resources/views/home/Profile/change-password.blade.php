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
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="card p-4">
        <div class="card-title">Change Password</div>
        <form action="{{ route('profile.update-password') }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="New Password" name="new_password">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Change Password
                <i class="bi bi-pencil-square"></i>
            </button>
        </form>
    </div>
</div>
@endsection