@extends('home.parent')

@section('content')
<div class="row d-flex justify-content-around">
    <div class="card p-4 text-center col-md-3">
        <img src="https://ui-avatars.com/api/background=random&name={{ Auth::user()->name }}" alt="" class="w-full rounded-circle">
        <h4 class="mt-4"> {{ Auth::user()->name }} </h4>
    </div>
    <div class="card p-4 col-md-8">
        <h2>Profile Account</h2>
        <!-- List group with active and disabled items -->
        <ul class="list-group">
            <h2 class="text-center">Account Details</h2>
            <li class="list-group-item active" aria-current="true">Name Account = <strong>{{ Auth::user()->name }}</strong></li>
            <li class="list-group-item">Email Account = <strong>{{ Auth::user()->email }}</strong></li>
            <li class="list-group-item">Role Account = <strong>{{ Auth::user()->role }}</strong></li>
        </ul><!-- End ist group with active and disabled items -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('profile.change-password') }}" class="btn btn-primary mt-5">
                Change Password
            </a>
        </div>
    </div>
</div>
@endsection