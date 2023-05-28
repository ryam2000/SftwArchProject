@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($post))
                    Edit existing post
                @else
                    Create new post
                @endif
            </h6>
        </div>
        <div class="card-body">

            {{-- Form::model ir Form::open metodai automatiškai prideda prie formos CSRF žetoną, todėl atskirai jo aprašyti nereikia --}}
            @if(isset($post))
                {{-- Esamo įrašo redagavimo forma --}}
                {!! Form::model($post, ['url' => ['admin/posts', $post->id], 'method' => 'patch']) !!}
            @else
                {{-- Naujo įrašo įvedimo forma; metodo nereikia nurodyti, nes pagal nutylėjimą jis yra 'post' --}}
                {!! Form::open(['url' => 'admin/posts']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Title: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('image_path', 'Image path: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('image_path', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('user_id', 'Poster ID: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
