<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cupon;
use App\Models\slide;
use App\Models\customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
class admindash extends Controller
{
    //
    public function adminhome()
    {
        $orderData = Order::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');
        $cusdata=customer::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('homeadmin',compact('orderData'))->with('cusdata',$cusdata);
        //return $orderData;
    }

    public function slide()
    {
        return view('slide');
    }

    public function registration(){
        return view ('adminregistration');
    }

    public function registersubmit(Request $req){
        $req->validate(
            [
                'name' => 'required|regex:/^[A-Z a-z.]+$/',
                'username' => 'required|min:5|max:20',
                'email' => 'required|email|email',
                'phone' => 'required|min:11|regex:/^01[5-9]{1}[0-9]{8}$/',
                'password' => 'required|min:3',
                'confirm_password' => 'required|same:password',
                'image' => 'required'
            ]
        );
        $filename = $req->username.'.'.$req->file('image')->getClientOriginalExtension();
        $req->file('image')->storeAs('public/AdminImage',$filename);

        $ad = new customer();
        $ad->name = $req->name;
        $ad->username = $req->username;
        $ad->email = $req->email;
        $ad->phone = $req->phone;
        $ad->password = md5($req->password);
        $ad->image = "storage/AdminImage/".$filename;
        $ad->role='Admin';
        $ad->save();
        session()->flash('msg','Suucessfully Registered');
        return  redirect()->route('registration');
    }

    public function managecupon()
    {
        return view('cupon');
    }


    public function cuponsubmit(Request $st)
    {
        $this->validate($st,
        [
            'name'=>'required|max:20',
            'code'=>'required|min:4',
            'dis'=>'required',
            'expired'=>'required', 
            'type'=>'required',
        ],
        [   'name.required'=>'Please provide username',
            'username.max'=>'Username must not exceed 20 alphabets',
            'code.required'=>'Please provide code',
            'type.required'=>'Please provide cupon type',
            'dis.required'=>'Please provide Discount Amount'
        ]
    );
    
    $em = new cupon();
    $em->Name = $st->name;
    $em->code = $st->code;
    $em->Discount=$st->dis;
    $em->expired=$st->expired;
    $em->type = $st->type;
    $em->save();
    
    if($em){

        $da=array("msg"=>"Coupon code Added Successfull");
        return response()->json($da);
    }
    else 
    {
        $da=array("msg"=>"Coupon code Added Unsuccessfull");
        return response()->json($da);
    }

}


public function cuponupdate(Request $st)
    {
        $this->validate($st,
        [
            'name'=>'required|max:20',
            'code'=>'required|min:4',
            'dis'=>'required',
            'expired'=>'required', 
            'type'=>'required',
        ]
    );
    
    $em = cupon::where('ID',$st->id)
    ->update(["Name" =>"$st->name","code" =>"$st->code",
    "Discount" =>"$st->dis","expired" =>"$st->expired",
    "type"=>"$st->type"]);
    
    
    if($em){

        $da=array("msg"=>"Coupon code Updated Successfull");
        return response()->json($da);
    }
    else 
    {
        $da=array("msg"=>"Coupon code Updated Unsuccessfull");
        return response()->json($da);
    }

    }

    public function managecuponlist()
    {
        $cupons = cupon::all();
        return response()->json($cupons);
    }


    public function deletecupon(Request $req){
        $m = cupon::where('ID',$req->id)->delete();
        if($m){
            $da=array("msg"=>"Coupon deleted Successfull");
            return response()->json($da);
            
        }
        else
        {
            $da=array("msg"=>"Coupon deleted Unsuccessfull");
            return response()->json($da);
        }
    }



public function slideup(Request $st)
    {
        $this->validate($st,
        [
            'name'=>'required|max:20',
            'image' => 'required'
        ],
        [   'name.required'=>'Please provide username',
            'username.max'=>'Username must not exceed 20 alphabets',   
        ]
    );

    $filename = $st->name.'.'.$st->file('image')->getClientOriginalExtension();
    $st->file('image')->storeAs('public/slide',$filename);
    
    $ex = new slide();
        $ex->name = $st->name;
        $ex->image = "storage/slide/".$filename;
        $ex->save();

        if($ex){
            $da=array("msg"=>"Slide Added Successfull");
            return response()->json($da);
        }
        else{
            $da=array("msg"=>"Slide Added Unsuccessfull");
            return response()->json($da);
        }

}


public function slideupdate(Request $st)
    {
        $this->validate($st,
        [
            'name'=>'required|max:20',
            'image' => 'required'
        ],
        [   'name.required'=>'Please provide username',
            'username.max'=>'Username must not exceed 20 alphabets',   
        ]
    );

    $filename = $st->name.'.'.$st->file('image')->getClientOriginalExtension();
    $st->file('image')->storeAs('public/slide',$filename);
    
$ex =slide::where('ID',$st->id)->update(["Name" =>"$st->name","image"=>"storage/slide/".$filename]);
        
        if($ex){
            $da=array("msg"=>"Slide Updated Successfull");
            return response()->json($da);
        }
        else{
            $da=array("msg"=>"Slide Updated Unsuccessfull");
            return response()->json($da);
        }

}

public function slidelist()
    {
        $slide = slide::all();
        return response()->json($slide);
    }


public function deleteslide(Request $req){
    $m = slide::where('ID',$req->id)->delete();
    if($m){
        $da=array("msg"=>"Slide deleted Successfull");
        return response()->json($da);
    }
    else
    {
        $da=array("msg"=>"Coupon deleted Unsuccessfull");
        return response()->json($da);
    }
}


}
