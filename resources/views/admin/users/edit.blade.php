@extends('layouts.admin')


@section('content')

    @include('include.form_errors')

    <h1>Edit User</h1>

    <div class="row">
        <div class="col-lg-4">
            <img src="{{$user->photo ? $user->photo->file : "http://placehold.it/400x400"}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-lg-8">
            {!! Form::model($user, ['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

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
                {!! Form::select('is_active',array(0=>'Not Active',1=>'Active'), null ,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::file('photo_id') !!}
            </div>

            <br>

            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::model($user, ['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete User',['class'=>'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>


@stop