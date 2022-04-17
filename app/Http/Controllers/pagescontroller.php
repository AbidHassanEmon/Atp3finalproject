<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\customer;
use Session;
class pagescontroller extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function loginsubmit(Request $st)
    {
        $valid=Validator::make($st->all(),
        [
            'uname'=>'required',
            'pass'=>'required'
        ]);
    if($valid->fails())
    {
        return response()->json(['error'=>$valid->errors()],401);
    }


    $val=customer::where('username',$st->uname)->where('password',md5($st->pass))->first();

    if($val)
    {
        $da=array("login"=>true,"role"=>$val->role);
            return response()->json($da);
       
    }
    else
    {
        $da=array("login"=>false);
        return response()->json($da);  
    }
    
 }


    public function Changepass()
    {
        return view('Changepass');   
    }

    public function Changepassubmit(Request $si)
    {
        $valid=Validator::make($si->all(),
        [
            'pass'=>'required|min:5|max:20',
            'npass'=>'required|same:pass', 
        ]
    );
    if($valid->fails())
    {
        return response()->json(['error'=>$valid->errors()],401);
    }
    
     $si=customer::where('ID',$si->id)->update(['password'=>md5($si->pass)]);
    if($si)
    {
        $da=array("msg"=>"Change password Successful");
        return response()->json($da);
    }
    else
    {
        $da=array("msg"=>"Change password Unsuccessful");
        return response()->json($da);

    }
     
      
}

public function location()
    {

        $ip = '103.97.162.38';
        //request()->ip();
        $data = \Location::get($ip);
       return $data;
       
    }
    


}
