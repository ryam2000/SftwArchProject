@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/comments/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add a new comment</a>
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
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Poster</th>
                        <th>Post</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment) {{-- iš valdiklio gavom autorių masyvą $authors; kadangi tai masyvas, reikia jį išskaidyti elementais --}}
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->user->name }} (ID: {{$comment->user_id}})</td>
                        <td>{{ $comment->post->title }} (ID: {{$comment->post_id}})</td>
                        <td>
                            <a href="{{ url('admin/comments/'.$comment->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="{{ url('admin/comments/'.$comment->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>
                            {!! Form::open(['method'=>'DELETE', 'url' => ['admin/comments', $comment->id], 'style' => 'display:inline']) !!}
                            {!! Form::button('<i class="fas fa-trash-alt"></i> Delete', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
