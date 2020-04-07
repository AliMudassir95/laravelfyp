@extends('layouts.admin')


@section('content')

    @include('include.form_errors')

    <h1>Edit Category</h1>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($category, ['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id],'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,["class"=>"form-control"]) !!}
            </div>
            <br>

            <div class="form-group">
                {!! Form::submit('Update Category',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::model($category, ['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete Category',['class'=>'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>


@stop