@extends('Layouts.app')
@section('content')
<h1>Salary List</h1>
    <table class='table table-bordered'>
        <th>ID</th>
        <th>Name</th>
        <th>PHONE</th>
        <th>Salary</th>
        <th>Date</th>
        @foreach($salarys as $salary)
            <tr>
                <td>{{$salary->s_id}}</td>
                <td>{{$salary->name}}</td>       
                <td>{{$salary->phone}}</td>
                <td>{{$salary->salary}}</td>
                <td>{{$salary->created_at}}</td>
            </tr>
        @endforeach
    </table>

@endsection