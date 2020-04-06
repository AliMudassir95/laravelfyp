@extends('layouts.admin')


@section('content')
    <h1>Create User</h1>

    {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store']) !!}

        <div class="form-group">
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email','Email:') !!}
            {!! Form::text('email',null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password',["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id','Role:') !!}
            {!! Form::select('role_id',[''=>"Choose Role"] + $roles,null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','Status:') !!}
            {!! Form::select('is_active',array(0=>'Not Active',1=>'Active'),0,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::file('file') !!}
        </div>

        <br>

        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

    @include('include.form_errors')
@stop