@extends('Layouts.app')
@section('content')
<h1>Employee List</h1>
<form method='get' action="{{route('employee/salary')}}">
    <table class='table table-bordered'>
        <th>ID</th>
        <th>Name</th>
        <th>PHONE</th>
        <th>Salary</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        @foreach($employee as $employees)
            <tr>
                <td>{{$employees->e_id}}</td>
                <td>{{$employees->name}}</td>       
                <td>{{$employees->phone}}</td>
                <td><input type='text' name='{{$employees->e_id}}'></td>
                <td><a class ="btn btn-success" href="/employee/view/{{$employees->e_id}}">View</a></td>
                <td><a class ="btn btn-success" href="/employee/edit/{{$employees->e_id}}">Edit</a></td>
                <td><a class ="btn btn-danger" href="/employee/delete/{{$employees->e_id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>
    <input type='submit' name='submit' value='pay' class='btn btn-success'>
    </form>
@endsection