@extends('inc.layout')
@section('content')
@include('inc.navbarcus')
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif

<br><br>
<h3>
            <h1>Product Details</h1>
        </h3>
        <img src = "{{asset($medicine->image)}}" height = "200px" width = "200px"><br>

        Name : {{$medicine->name}} <br>
        Price : {{$medicine->unit_price}}$<br>
        {{$medicine->stock}} units Available<br>
        How many units do you want? <br>
        <form action = "" method = "post">
            {{csrf_field()}}
            <input type = "text" name = "unit" placeholder = "Units"><br><br>
            @error('unit')
                <span class = "text-danger">{{$message}}</span><br>
            @enderror
            Add cupon code [If you have one]<br>
            <input type = "text" name = "cupon" placeholder = "ADD CUPON CODE"><br><br>

            <input type = "submit" class = "btn btn-success" value = "Place Order"></a>
        </form>

        <form action = "{{route('fav')}}" method = "post">
            {{csrf_field()}}
            <input type = "hidden" name = "product_id" value={{$medicine->id}}>
            <input type = "submit" class = "btn btn-primary" value = "ADD TO Favourite"></a>
        </form>

        </center>
@endsection