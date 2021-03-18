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
                    <form action="{{ route('sign-in-admin-post') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="InputEmail">Username</label>
                            <input type="text" value="{{ old('username') }}"
                                   class="form-control @error('username') is-invalid @enderror" name="username" id="InputUsername" aria-describedby="usernameHelp">
                            @error('username')
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


