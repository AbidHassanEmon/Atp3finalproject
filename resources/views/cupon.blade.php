@extends('inc.layout')
@section('content')
@include('inc.navadmin')
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif</center>
<br>
<h1>Manage Coupon</h1><br><br>

<form action = "{{route('cupon')}}" method = "post">
    {{@csrf_field()}}
        <input type = "text" name = "name"placeholder = "Cupon Name"><br><br>
        @error('name')
            <span class = "text-danger">{{$message}}</span><br>
        @enderror
        <input type = "text" name = "code" placeholder = "Cupon code"><br><br>
        @error('code')
            <span class = "text-danger">{{$message}}</span><br>
        @enderror
        <input type = "text" name = "dis" placeholder = "Discount"><br><br>
        @error('dis')
            <span class = "text-danger">{{$message}}</span><br>
        @enderror
        <input type = "text" name = "type" placeholder = "Fixed/%"><br><br>
        @error('type')
            <span class = "text-danger">{{$message}}</span><br>
        @enderror
        <input type = "submit" class = "btn btn-primary" value = "Add Cupon">
</form>
<br><br>

@endsection