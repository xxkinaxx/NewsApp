@extends('home.parent')

@section('content')
<div class="container">
    <div class="row card p-4">
        <h1 class="text-center">Welcome {{ Auth::user()->name }}</h1>
        <hr>

        <!-- List group with active and disabled items -->
        <ul class="list-group">
            <h2 class="text-center">Account Details</h2>
            <li class="list-group-item active" aria-current="true">Name Account = <strong>{{ Auth::user()->name }}</strong></li>
            <li class="list-group-item">Email Account = <strong>{{ Auth::user()->email }}</strong></li>
            <li class="list-group-item">Role Account = <strong>{{ Auth::user()->role }}</strong></li>
        </ul><!-- End ist group with active and disabled items -->
    </div>
</div>
@endsection