

@extends('inc.layout')
@section('content')
@include('inc.navadmin')
<br>
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif</center>

<a class="btn" href="cupon"><button type="button" class="btn btn-success">ADD COUPON</button></a>
<br><br>

<table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>code</th>
            <th>discount</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>

        <tr>
        @foreach($cupons as $x)
                <tr align = "center">
                    <td>{{$x->ID}}</td>
                    <td>{{$x->Name}}</td>
                    <td>{{$x->code}}</td>
                    <td>{{$x->Discount}}</td>
                    <td>{{$x->type}}</td>
<td> <a href = "{{route('cupon.delete',['id'=>$x->ID])}}" ><input type = "button" class = "btn btn-danger" value = "Delete"></td>
                </tr>
            @endforeach
        </tr>
        
</table>
<br><br><br>
@endsection