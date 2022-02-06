@extends('Layouts.app')
@section('content')
<h1>User List</h1>
    <table class='table table-bordered'>
        <th>ID</th>
        <th>Name</th>
        <th>PHONE</th> 
        <th>UserType</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        @foreach($users as $user)
            <tr>
                <td>{{$user->u_id}}</td>
                <td>{{$user->name}}</td>       
                <td>{{$user->phone}}</td>
                <td>{{$user->usertype}}</td>
                <td><a class ="btn btn-success" href="/user/view/{{$user->u_id}}">View</a></td>
                <td><a class ="btn btn-success" href="/user/edit/{{$user->u_id}}">Edit</a></td>
                <td><a class ="btn btn-danger" href="/user/delete/{{$user->u_id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>
@endsection