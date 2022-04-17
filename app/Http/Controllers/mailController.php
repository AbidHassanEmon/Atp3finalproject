<?php

namespace App\Http\Controllers;
use App\Mail\TestMail;
use App\Models\customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class mailController extends Controller
{
    //try for otp
    public function sendEmail(){
        $details = 
        [
            'title'=>'mail from abid hassan emon',
            'body'=> 'This is the first mail for me using laravel.'
        ];
        Mail::to("abidhassanemon352@gmail.com")->send(new TestMail($details));
        return "Email send Successfull";
    }

    public function ForgetEmail(Request $r){
        $st=Str::random(5);
        $email=$r->email;
        $si=customer::where('email',$email)->update(['otp'=>"$st"]);
        $details = 
        [
            'title'=>'Forget password email',
            'body'=> 'Your OTP for forget password is : '.$st 
        ];
        Mail::to($email)->send(new TestMail($details));
        return "OTP send Successfull";
    }

    public function Forgetpassword(Request $r)
    {
        $email=$r->email;
        $otp=$r->otp;
        $pass=$r->password;
        $si=customer::where('email',$email)->first();
        if($si->otp == $otp)
        {
            $so=customer::where('email',$email)->update(['password'=>md5($pass)]);
            if($so)
            {
                $da=array("otp"=>"Password change Successfull");
                return response()->json($da);
            }
            else
            {
                $da=array("otp"=>"Password change Unsuccessfull");
                return response()->json($da);  
            }
            
        }
        else
        {
            return "OTP Is Wrong"; 
        }
    }
    
}
