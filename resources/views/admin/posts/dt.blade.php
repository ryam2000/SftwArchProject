@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/posts/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add a post...</a>
        </div>
        <div class="card-body">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif

            <div class="table-responsive">
                <table id="posts" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image Path</th>
                        <th>Poster</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->image_path }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                <a href="{{ url('admin/posts/'.$post->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="{{ url('admin/posts/'.$post->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>
                                {!! Form::open(['method'=>'DELETE', 'url' => ['admin/posts', $post->id], 'style' => 'display:inline']) !!}
                                {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @section('extra-script')
                    {{Html::script('public/js/posts.js')}}
                @endsection
            </div>
        </div>
    </div>
@endsection
