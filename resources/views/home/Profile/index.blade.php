@extends('home.parent')

@section('content')
    <div class="card p-4">
        <h1> {{ Auth::user()->name }} </h1>
    </div>
@endsection