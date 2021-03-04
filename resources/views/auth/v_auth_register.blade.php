@extends('layouts.v_layouts_home')

@section('title',  $title)

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $title }}</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('messages'))
                        {!! session('messages') !!}
                    @endif
                    <form action="{{ route('sign-up-post') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="InputName">Your Name</label>
                            <input type="text" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror" name="name" id="InputName">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="InputEmail">Email address</label>
                            <input type="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror" name="email" id="InputEmail" aria-describedby="emailHelp">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="InputPassword">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


