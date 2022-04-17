<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Medicine;
use App\Models\cupon;
use Validator;

class OrderController extends Controller
{
    
    public function ordermedicine(Request $req){

    //unit,cus_id,id(medicine),cupon(optional) 

        $valid=Validator::make($req->all(),
        [
            'unit'=>'required|numeric'
        ]);
        if($valid->fails())
        {
            return response()->json(['error'=>$valid->errors()],405);
        }

        $customer_id = $req->cus_id;
        $discount=0;
        if($req->cupon)
        {
            $cup = cupon::all();
            foreach ($cup as $it) {
                
                if(strtoupper($req->cupon)==strtoupper($it->code))
                {
                    $discount=$it->Discount;
                     
                }
            }
        }
        
        $medicine = Medicine::where('id',$req->id)->first();
        $medicine->stock = $medicine->stock-$req->unit;
        $medicine->save();

        $order = new Order();
        $order->medicine_id = $medicine->id;
        $order->patient_id = $customer_id;
        $order->deliveryman_id = 1;
        $order->order_quantity = $req->unit;
        $order->total_price = ($medicine->unit_price*$req->unit)-$discount;

        $em = $order->save();

        if($em){

            $da=array("msg"=>" Order placed with discount ".$discount."tk");
            return response()->json($da);
        }
    }

    public function orderlist(){

        $order = Order::all();
        return response()->json($order);
    }



}
