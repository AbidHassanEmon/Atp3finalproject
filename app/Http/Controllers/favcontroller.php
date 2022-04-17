<?php

namespace App\Http\Controllers;
use App\Models\fav;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Validator;

class favcontroller extends Controller
{
    //
    public function addfev(Request $r)
    {

        $valid=Validator::make($r->all(),
        [
            'product_id'=>'required',
            'id'=>'required'
        ]);
    if($valid->fails())
    {
        return response()->json(['error'=>$valid->errors()],401);
    }

        $fav=new fav;
        $fav->product_id=$r->product_id;
        $fav->user_id=$r->id;
        $w=$fav->save();
        if($w){
            $da=array("msg"=>"Added to favourite");
            return response()->json($da);
        }
        else
        {
            $da=array("msg"=>"error");
            return response()->json($da);
        }
        
    }

    public function addfevlist(Request $r)
    {
        //$user_id=Session::get('loged')['id'];
        $user_id=$r->id;
        $w=DB::table('favs')->join('medicines','favs.product_id','=','medicines.id')
        ->where('favs.user_id',$user_id)
        ->select('medicines.name','medicines.unit_price','medicines.description','medicines.image')->get();

        return response()->json($w);
        
    }

    public function addfevdel(Request $r)
    {
        $w=fav::where('user_id',$r->id)->where('product_id',$r->p_id)->delete();
    
        if($w){
            $da=array("msg"=>"Deleted From favourite");
            return response()->json($da);
        }
        else
        {
            $da=array("msg"=>"error");
            return response()->json($da);
        }
        
    }

    public function addfevclear(Request $r)
    {
        $w=fav::where('user_id',$r->id)->delete();
    
        if($w){
            $da=array("msg"=>"Favourite list is Empty");
            return response()->json($da);
        }
        else
        {
            $da=array("msg"=>"error");
            return response()->json($da);
        }
        
    }


    
}
