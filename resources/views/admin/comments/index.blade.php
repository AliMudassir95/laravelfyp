@extends('layouts.admin')

@section('content')

    <h1>All Comments</h1>
    {{--  @if(Session::has('message'))--}}
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">By</th>
            <th scope="col">Post</th>
            <th scope="col">email</th>
            <th scope="col">Body</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
        </tr>
        </thead>
        <tbody>
        @if($comments)
            @foreach($comments as $comment)
                <tr>
{{--                    <th>--}}
{{--                        <a href="{{route('admin.comments.edit',$comment->id)}}" class="btn btn-primary">Edit</a>--}}
{{--                    </th>--}}
                    <th scope="row">{{$comment->id}}</th>
                    <td><img class="img-circle" width="50" height="40" src="{{$comment->photo ? $comment->photo : "http://placehold.it/400x400"}}" alt=""></td>
                    <td>{{$comment->author}}</td>
                    <td><a href="{{route('home.post',$comment->post->id)}}">{{$comment->post->title}}</a></td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>{{$comment->updated_at->diffForHumans()}}</td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::model($comment, ['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Dis-Approve',['class'=>'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}

                            @else
                                {!! Form::model($comment, ['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}

                                <input type="hidden" name="is_active" value="1">

                                <div class="form-group">
                                    {!! Form::submit('Approve',['class'=>'btn btn-success']) !!}
                                </div>

                                {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::model($comment, ['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}

                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a href="{{route('admin.comment.replies.show',$comment->id)}}">Replies</a>
                    </td>
                </tr>
            @endforeach

        @else
            <p>No Comments</p>
        @endif



        </tbody>
    </table>


@stop