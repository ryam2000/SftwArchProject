@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/posts/'.$post->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i>Edit post</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $post->description }}</td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><img src="../images/{{ $post->image_path }}"></td>
                    </tr>
                    <tr>
                        <td>Poster</td>
                        <td>{{ $post->user->name}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
