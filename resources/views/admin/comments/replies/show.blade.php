@extends('layouts.admin')

@section('content')

    <h1>Comment Replies</h1>
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
        @if($replies)
            @foreach($replies as $reply)
                <tr>
                    {{--                    <th>--}}
                    {{--                        <a href="{{route('admin.replies.edit',$reply->id)}}" class="btn btn-primary">Edit</a>--}}
                    {{--                    </th>--}}
                    <th scope="row">{{$reply->id}}</th>
                    <td><img class="img-circle" width="50" height="40" src="{{$reply->photo ? $reply->photo : "http://placehold.it/400x400"}}" alt=""></td>
                    <td>{{$reply->author}}</td>
                    <td><a href="{{route('home.post',$reply->comment->post->id)}}">{{$reply->comment->post->title}}</a></td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td>{{$reply->updated_at->diffForHumans()}}</td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::model($reply, ['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Dis-Approve',['class'=>'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}

                        @else
                            {!! Form::model($reply, ['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve',['class'=>'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::model($reply, ['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}

                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        @else
            <p>No replies</p>
        @endif



        </tbody>
    </table>


@stop