@extends('Layouts.app')
@section('content')
    <form action="{{route('employee/create')}}" method='POST'>
        {{csrf_field()}}
        <div class='col-md-2 form-group'>
            <span>ID</span>
            <input type='text' name='e_id' value="{{$id}}" class='form-control' readonly>
        </div>
        <div class='col-md-2 form-group'>
            <span>Name</span>
            <input type='text' name='name' value="{{old('name')}}" class='form-control'>
            @error('name')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>DOB</span>
            <input type='date' name='dob' value="{{old('dob')}}" class='form-control'>
            @error('dob')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Address</span>
            <input type='text' name='address' value="{{old('address')}}" class='form-control'>
            @error('address')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Email</span>
            <input type='text' name='email' value="{{old('email')}}" class='form-control'>
            @error('email')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <div class='col-md-2 form-group'>
            <span>Phone</span>
            <input type='text' name='phone' value="{{old('phone')}}" class='form-control'>
            @error('phone')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>  
        <div class='col-md-2 form-group'>
            <span>Password</span>
            <input type='password' name='password' value="{{old('password')}}" class='form-control'>
            @error('password')
                <span class='text-danger'>{{$message}}</span>
            @enderror
        </div>
        <input type='submit' name='submit' value='Add' class='btn btn-success'>
    </form>
@endsection