@extends('inc.layout')
@section('content')
@include('inc.navbarcus')
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif</center>

@foreach($pic as $m)
<img src = "{{asset($m->image)}}" height = "300px" width = "410px">
@endforeach
<h1>customer Dash</h1><br><br>

<table>
            <tr>
                <th></th>
                <th>------Medicine Name------</th>

                <th>------Price------</th>
                <th> ------Stock------</th>
                <th>------Desciption------</th>
            </tr>

            <tr>
                @foreach($medicines as $m)
                    <tr align = "center">
                        <td><a href = "{{route('medicinedetails', ['id'=>$m->id,'name'=>$m->name])}}"><img src = "{{asset($m->image)}}" height = "100px" width = "100px"></a></td>
                        <td>{{$m->name}}</td>
                        <td class = "text-success">{{$m->unit_price}} Taka</td>
                        <td class = "text-danger">{{$m->stock}} Units</td>
                        <td>{{$m->description}}</td>
                        
                        
                    </tr>
                @endforeach
            </tr>
        </table>


@endsection