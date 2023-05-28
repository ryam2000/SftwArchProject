@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($comment))
                    Edit existing comment
                @else
                    Create new comment
                @endif
            </h6>
        </div>
        <div class="card-body">

            {{-- Form::model ir Form::open metodai automatiškai prideda prie formos CSRF žetoną, todėl atskirai jo aprašyti nereikia --}}
            @if(isset($comment))
                {{-- Esamo įrašo redagavimo forma --}}
                {!! Form::model($comment, ['url' => ['admin/comments', $comment->id], 'method' => 'patch']) !!}
            @else
                {{-- Naujo įrašo įvedimo forma; metodo nereikia nurodyti, nes pagal nutylėjimą jis yra 'post' --}}
                {!! Form::open(['url' => 'admin/comments']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('content', 'Content: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('content', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('user_id', 'User ID: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('post_id', 'Post ID: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('post_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
