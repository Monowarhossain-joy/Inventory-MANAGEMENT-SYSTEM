@extends('Layouts.app')
@section('content')
    <form action="{{route('employee/edit')}}" method='POST'>
        {{csrf_field()}}
        <input type='hidden' name='id' value="{{$employee->id}}">
        <div class='col-md-2 form-group'>
            <span>ID</span>
            <input type='text' name='e_id' value="{{$employee->e_id}}" class='form-control' readonly>
        </div>
        <div class='col-md-2 form-group'>
            <span>Name</span>
            <input type='text' name='name' value="{{$employee->name}}" class='form-control'>
            @error('name')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Date of Birth</span>
            <input type='date' name='dob' value="{{$employee->dob}}" class='form-control'>
            @error('dob')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Address</span>
            <input type='text' name='address' value="{{$employee->address}}" class='form-control'>
            @error('address')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Phone</span>
            <input type='text' name='phone' value="{{$employee->phone}}" class='form-control' readonly>
        </div>
        <div class='col-md-2 form-group'>
            <span>Email</span>
            <input type='text' name='email' value="{{$employee->email}}" class='form-control'>
            @error('email')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <input type='submit' name='submit' value='Update' class='btn btn-success'>
    </form>
@endsection