@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/comments/'.$comment->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i>Edit comment</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $comment->id }}</td>
                    </tr>
                    <tr>
                        <td>Content</td>
                        <td>{{ $comment->title }}</td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>{{ $comment->user->name}}</td>
                    </tr>
                    <tr>
                        <td>Post</td>
                        <td>{{ $comment->post->title}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
