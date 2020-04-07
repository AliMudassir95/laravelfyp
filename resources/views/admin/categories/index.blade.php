@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>
    {{--  @if(Session::has('message'))--}}
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-5">
            {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}
                <div class="form-group">
                    {!! Form::label('category name','Category:') !!}
                    {!! Form::text('name',null,["class"=>"form-control"]) !!}
                </div>
                <br>

                <div class="form-group">
                    {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        <div class="col-lg-7 span-7">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $category)
                        <tr>
                            <th>
                                <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                            </th>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td>{{$category->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
        </div>
    </div>


@stop