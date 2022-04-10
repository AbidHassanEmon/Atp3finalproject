@extends('inc.layout')

@section('content')
@include('inc.navadmin')<br>
<table class="table table-bordered">
            <tr>
                <th>
                    NO
                </th>
                
                <th>
                    Medicine ID
                </th>
                <th>
                    Order Quantity
                </th>
                <th>
                    Ordered Medicine
                </th>
                <th>
                    Unit Price
                </th>
                <th>
                    Total Price
                </th>
                <th>
                    Updated At
                </th>
                <th>
                    Ordered At
                </th>
            </tr>
            
            <tr>
                @foreach($order as $o)
                    <tr align = "center">
                        <td>{{$o->id}}</td>
                
                        <td>{{$o->medicine_id}}</td>
                        <td>{{$o->order_quantity}}</td>
                        <td>{{$o->medicine->name}}</td>
                        <td>{{$o->medicine->unit_price}}</td>
                        <td>{{$o->total_price}}</td>
                        <td>{{$o->updated_at}}</td>
                        <td>{{$o->created_at}}</td>
                    </tr>
                @endforeach
            </tr>

        </table>
@endsection