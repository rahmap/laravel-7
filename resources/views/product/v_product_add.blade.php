@extends('layouts.v_layouts_home')

@section('title',  $title)

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $title }}</h1>
            <p class="lead">Add your best products.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('messages'))
                        {!! session('messages') !!}
                    @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="InputName">Product Name</label>
                                        <input type="text" value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror" name="name" id="InputName">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product Short Description</label>
                                        <input type="text" value="{{ old('short_description') }}"
                                               class="form-control @error('short_description') is-invalid @enderror" name="short_description">
                                        @error('short_description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product Description</label>
                                        <input type="text" value="{{ old('description') }}"
                                               class="form-control @error('description') is-invalid @enderror" name="description">
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Product Price</label>
                                        <input type="number" value="{{ old('price') }}"
                                               class="form-control @error('price') is-invalid @enderror" name="price" step="1000">
                                        @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="InputImage">Product Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="InputImage">
                                        @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary align-center">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection


