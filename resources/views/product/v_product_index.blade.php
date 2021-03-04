@extends('layouts.v_layouts_home')

@section('title',  $title)

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $title }} <span class="text-primary">{{ config('app.name') }}</span></h1>
            <p class="lead">Here your garbage products.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('messages'))
                {!! session('messages') !!}
            @endif
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
{{--                @foreach ($users as $user)--}}
{{--                    <tr>--}}
{{--                        <th scope="row">{{ $user['id'] }}</th>--}}
{{--                        <td>{{ $user['name'] }}</td>--}}
{{--                        <td>{{ $user['email'] }}</td>--}}
{{--                        <td>{{ $user['created_at'] }}</td>--}}
{{--                        <td class="text-center">--}}
{{--                            <div class="btn btn-danger btnDelete" data-id="{{ $user['id'] }}">Hapus</div>--}}
{{--                            <div class="btn btn-primary btnUpdate" data-id="{{ $user['id'] }}">Update</div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>
    <form id="formDelete" action="" method="post">
        @method('DELETE')
        @csrf
    </form>
    <form id="formUpdate" action="" method="post">
        @csrf
    </form>
    <script>
        let btnDelete = $('.btnDelete')
        let formDelete = $('#formDelete')
        btnDelete.click(function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    formDelete.attr('action', '{{ url('delete') }}/' + $(this).data('id'))
                    formDelete.submit()
                }
            })
        })

        let btnUpdate = $('.btnUpdate')
        let formUpdate = $('#formUpdate')
        btnUpdate.click(function(){
            formUpdate.attr('action', '{{ url('edit') }}/' + $(this).data('id'))
            formUpdate.submit()
        })
    </script>
@endsection
