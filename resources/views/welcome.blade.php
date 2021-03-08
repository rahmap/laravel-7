@extends('layouts.v_layouts_home')

@section('title',  $title)

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Welcome <span class="text-primary">{{ Auth::user()->name }}</span></h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>

@endsection
