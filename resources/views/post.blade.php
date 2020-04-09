@extends('layouts.blog-post')

@section('styles')
    <style>
        .nested-comment{
            display:none;
        }
    </style>
@stop
@section('content')
    <!-- Blog Post -->
    <div class="col-lg-8">
        @extends('include.flashmessage')
    </div>

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo_id ? $post->photo->file : "http://placehold.it/900x300"}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">Category: {{$post->category->name}}</p>

    <p>{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->
    @if(Auth::check())
        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            @include('include.form_errors')
            {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}

                {!! Form::hidden('post_id',$post->id,["class"=>"form-control"]) !!}
                <div class="form-group">
                    {!! Form::label('body','Comment:') !!}
                    {!! Form::textarea('body',null,["class"=>"form-control"]) !!}
                </div>
                <br>
                <div class="form-group">
                    {!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->

    @if($comments)
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object img-responsive img-circle" width="40" src="{{$comment->photo ? $comment->photo : "http://placehold.it/64x64"}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$comment->body}}

                   {{--reply section--}}
                    <div class="comment-reply-container">
                        @if(count($comment->replies) > 0)
                            <button class="btn btn-primary toggle-reply pull-right">Show Reply {{count($comment->replies)}}</button><br>
                            @foreach($comment->replies as $reply)
                                @if($reply->is_active == 1)

                                    <br>
                                    <div class="reply-comment">
                                        <div class="media nested-comment">
                                            <a class="pull-left" href="#">
                                                <img class="media-object img-responsive img-circle" width="40" src="{{$reply->photo != "" ? $reply->photo : "http://placehold.it/64x64"}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$reply->author}}
                                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                                </h4>
                                                {{$reply->body}}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        @endif
                    </div>
                    {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@publicReplies']) !!}

                        {!! Form::hidden('comment_id',$comment->id,["class"=>"form-control"]) !!}
                        <div class="form-group">
                            {!! Form::label('body','Reply:') !!}
                            {!! Form::textarea('body',null,["class"=>"form-control",'rows'=>2]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Reply',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}

                   {{--reply section end--}}


                </div>
            </div>
        @endforeach
    @endif
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.comment-reply-container .toggle-reply').click(function () {
                $('.nested-comment').toggle('slow');
            });
        });
    </script>
@stop