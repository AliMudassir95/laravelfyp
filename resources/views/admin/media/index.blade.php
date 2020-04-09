@extends('layouts.admin')

@section('content')

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <table class="table">
      <thead>
        <tr>
          <th>Action</th>
          <th scope="col">ID</th>
          <th scope="col">File</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
        </tr>
      </thead>
      <tbody>
      @if($photos)
        @foreach($photos as $photo)
          <tr>
              <th>
                  {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$photo->id]]) !!}

                      {!! Form::submit('Delete Photo',['class'=>'btn btn-danger']) !!}

                  {!! Form::close() !!}
              </th>
            <th scope="row">{{$photo->id}}</th>
            <td>
                <img class="img-responsive img-rounded" width="100" height="100" src="{{$photo->file}}" alt="">
            </td>
            <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No Date'}}</td>
            <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No Date'}}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>

    <div class="row">
        <div class="col-lg-5 col-lg-offset-4">
            {{$photos->render()}}
        </div>
    </div>

@stop