@extends('layouts.admin')



@section('content')
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
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Status</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
        </tr>
      </thead>
      <tbody>
       @if($users)
         @foreach($users as $user)
           <tr>
             <th>
               <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
             </th>
             <th scope="row">{{$user->id}}</th>
             <td><img width="50" src="{{$user->photo ? $user->photo->file : "http://placehold.it/400x400"}}" alt=""></td>
             <td>{{$user->name}}</td>
             <td>{{$user->email}}</td>
             <td>{{$user->role->name}}</td>
             <td>{{$user->is_active == 1 ? "Active" : "Not Active"}}</td>
             <td>{{$user->created_at->diffForHumans()}}</td>
             <td>{{$user->updated_at->diffForHumans()}}</td>
           </tr>
         @endforeach
       @endif


      </tbody>
    </table>

@endsection