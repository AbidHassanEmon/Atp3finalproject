@extends('inc.layout')

@section('content')
@include('inc.navadmin')<br>
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif</center>
<center>
<h3>Registration</h3>

            <form action = "{{route('register.submit')}}" method = "post" enctype = "multipart/form-data">
                {{csrf_field()}}

                <input type = "text" name = "name" value = "{{old('name')}}" placeholder = "Full Name"><br><br>
                @error('name')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror

                <input type = "text" name = "username" value = "{{old('username')}}" placeholder = "Username"><br><br>
                @error('username')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror

                <input type = "text" name = "email" value = "{{old('email')}}" placeholder = "Email"><br><br>
                @error('email')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror

                <input type = "text" name = "phone" value = "{{old('phone')}}" placeholder = "Phone Number"><br><br>
                @error('phone')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror

                <input type = "password" name = "password" placeholder = "Passwords"><br><br>
                @error('password')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror
                
                <input type = "password" name = "confirm_password" placeholder = "Confirm Passwords"><br><br>
                @error('confirm_password')
                    <span class = "text-danger">{{$message}}</span> <br>
                @enderror

                Profile Picture<br><input type = "file" name = "image"><br><br>
                @error('image')
                    <span class = "text-danger">{{$message}}</span><br>
                @enderror
                <input type = "submit" class = "btn btn-primary" value = "Register">
                
            </form>
</center>
@endsection