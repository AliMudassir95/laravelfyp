@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>
    {{--  @if(Session::has('message'))--}}
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Action</th>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">By</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <th>
                        <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                    </th>
                    <th scope="row">{{$post->id}}</th>
                    <td><img class="img-circle" width="50" height="40" src="{{$post->photo ? $post->photo->file : "http://placehold.it/400x400"}}" alt=""></td>
                    <td>{{$post->user_id ? $post->user->name : 'Unknown'}}</td>
                    <td><a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a></td>
                    <td>{{$post->category_id ? $post->category->name : 'Unknown'}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <a href="{{route('admin.comments.show',$post->id)}}">Show Comments</a>
                    </td>
                </tr>
            @endforeach
        @endif


        </tbody>
    </table>


@stop