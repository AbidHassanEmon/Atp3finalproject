<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    //
    public function medicine(){
        return view ('addmedicine');
    }

    public function addmedicine(Request $req)
    {
        $valid=Validator::make($req->all(),
            [
                'name' => 'required|unique:medicines,name',
                'unit_price' => 'required',
                'stock' => 'required',
                'description' =>'required',
                'image' => 'required|mimes:jpg,png'
            ]
        );
        if($valid->fails())
    {
        return response()->json(['error'=>$valid->errors()],401);
    }

        $filename = $req->name.'.'.$req->file('image')->getClientOriginalExtension();
        $req->file('image')->storeAs('public/MedicineImage',$filename);

        $m = new Medicine();
        $m->name = $req->name;
        $m->unit_price = $req->unit_price;
        $m->stock = $req->stock;
        $m->description = $req->description;
        $m->image = "storage/MedicineImage/".$filename;
        $m->save();

        if($m){

        $da=array("msg"=>"Medicine Added Successfull");
        return response()->json($da);
    }
    else 
    {
        $da=array("msg"=>"Medicine Added Unsuccessfull");
        return response()->json($da);
    }
}


public function listmedicine(){

        $medicines = Medicine::all();
        return response()->json($medicines);
    
    }


    public function delete(Request $req){
        $m = Medicine::where('id',$req->id)->delete();
        if($m){
            $da=array("msg"=>"Medicine delete Successfull");
            return response()->json($da);
            
        }
    }

    public function editmedicine(Request $req){
        $m = Medicine::where('id',$req->id)->first();
        return view('updatemedicine')->with('m',$m);
    }

    public function updatemedicine(Request $req){
        $valid=Validator::make($req->all(),
            [
                'name' => 'required',
                'unit_price' => 'required',
                'stock' => 'required',
                'description' =>'required'
            ]
        );
        if($valid->fails())
        {
            return response()->json(['error'=>$valid->errors()],401);
        }

        $m = Medicine::where('id',$req->id)->first();
        $m->name = $req->name;
        $m->unit_price = $req->unit_price;
        $m->stock = $req->stock;
        $m->description = $req->description;
        $m->save();
        
        if($m){
            $da=array("msg"=>"Medicine updated Successfull");
            return response()->json($da);
            
        }
        
    }

    public function medicinedetails(Request $req){
        $medicine = Medicine::where('id',$req->id)->first();
        return view ('medicinedetails')->with('medicine',$medicine);
    }

//search api
    public function medicinesearch(Request $req){

        $medicine = Medicine::where('name','like','%'.$req->name.'%')->get();
        return $medicine;
    }


}
