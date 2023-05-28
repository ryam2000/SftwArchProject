@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div class="card">
        <div class="card-header">@extends('layouts.admin')

            @section('title', 'Roles')

            @section('content')
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('admin/roles/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add role</a>
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
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ url('admin/roles/'.$role->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ url('admin/roles/'.$role->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>
                                            {!! Form::open(['method'=>'DELETE', 'url' => ['admin/roles', $role->id], 'style' => 'display:inline']) !!}
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

            <a href="{{ url('admin/users/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add user</a>
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
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                            <td>
                                <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="{{ url('admin/users/'.$user->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a>
                                {!! Form::open(['method'=>'DELETE', 'url' => ['admin/users', $user->id], 'style' => 'display:inline']) !!}
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
