<?php

namespace App\Http\Controllers;

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
        $req->validate(
            [
                'name' => 'required|unique:medicines,name',
                'unit_price' => 'required',
                'stock' => 'required',
                'description' =>'required',
                'image' => 'required|mimes:jpg,png'
            ]
        );
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

            session()->flash('msg','Medicine Added successfull');
            return redirect()->route('medicinelist');

        }   
    }

    public function listmedicine(){

        $medicines = Medicine::all();
        return view ('medicinelist')->with('medicines',$medicines);
    
    }


    public function delete(Request $req){
        $m = Medicine::where('id',$req->id)->delete();
        if($m){
            session()->flash('msg','Succesfully Deleted');
            return redirect()->route('medicinelist');
            
        }
    }

    public function editmedicine(Request $req){
        $m = Medicine::where('id',$req->id)->first();
        return view('updatemedicine')->with('m',$m);
    }

    public function updatemedicine(Request $req){
        $req->validate(
            [
                'name' => 'required',
                'unit_price' => 'required',
                'stock' => 'required',
                'description' =>'required'
            ]
        );

        $m = Medicine::where('id',$req->id)->first();
        $m->name = $req->name;
        $m->unit_price = $req->unit_price;
        $m->stock = $req->stock;
        $m->description = $req->description;
        $m->save();
        
        if($m){
            session()->flash('msg','Medicine Updated');
            return redirect()->route('medicinelist')->with ('m',$m);
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
