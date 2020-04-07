@extends('layouts.admin')

@section('content')

    <h1>Edit Post</h1><br>


         <div class="col-lg-12">
             <img class="img-rounded img-responsive" src="{{$post->photo_id ? $post->photo->file : "http://placehold.it/400x400"}}" alt="">
            <br>
         </div>
         <div class="col-lg-12">
             {!! Form::model($post, ['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}

                 <div class="form-group">
                     {!! Form::label('title','Title:') !!}
                     {!! Form::text('title',null,["class"=>"form-control"]) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::label('category_id','Category:') !!}
                     {!! Form::select('category_id',[''=>"Choose Category"] + $categories,null,["class"=>"form-control"]) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::label('body','Content:') !!}
                     {!! Form::textarea('body',null,["class"=>"form-control",'row'=>'3']) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::file('photo_id') !!}
                 </div>

                 <br>

                 <div class="form-group">
                     {!! Form::submit('Update Post',['class'=>'btn btn-primary']) !!}
                 </div>

             {!! Form::close() !!}

             {!! Form::model($post, ['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}

                {!! Form::submit('Delete Post',['class'=>'btn btn-danger']) !!}

             {!! Form::close() !!}
         </div>

    @include('include.form_errors')

@stop