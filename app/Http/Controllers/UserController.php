<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){
        return view('user.userLogin');
    }
    public function registrationPage(){
        return view('user.regPage');   
    }
    public function sendOTPCode(){
        return view('user.sendOTP');
    }
    public function userProfilePage(){
        return view('user.userProfile');
    }
    // public function submitOTP(){
    //     return view('submitOTP');
    // }

    public function saveRegistration(Request $request){
        //  dd($request->all());
        try{
             User::create([
                'first_name'=> $request->input('first_name'),
                'last_name'=> $request->input('last_name'),
                'email'=> $request->input('email'),
                'fax'=> $request->input('fax'),
                'phone'=> $request->input('phone'),
                'password'=> $request->input('password'),
                // 'otp' => rand(100000, 999999)
                // 'otp' => $request->otp,

            ]);
            return response()->json([
                'status'=> 'success',
                'message'=> 'User Registration Successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=> 'failed',
                'message'=>$e->getMessage()
            ]);
        }
       
    }
    
    public function userLogin(Request $request){
        $count = User::where('email',$request->email)
                        ->where('password',$request->password)
                        ->select('id')->first();
        if($count !== null){
            $token = JWTToken::createToken($request->email,$count->id);
            return redirect()->route('dashboard')
                    ->cookie('token', $token, 60 * 20 * 30);
            ;
        }else{
             return response()->json([
                'status'=>'failed',
                'message'=>'User Log in Failed/Unauthorized'
            ]);
        }                
    }
    public function getOTPCode(Request $request){
        $email = $request->input('email');
        $otp = rand(min:1000,max:9999);
        $count = User::where('email','=',$email)
                ->count();

        if($count == 1){
            Mail::to($email)->send(new OTPMail(otp:$otp));
            User::where('email','=',$email)->update(['otp'=> $otp]);

            session(['otp_email' => $email]);

            return view('user.submitOTP');
            // return response()->json([
            //     'status'=>'success',
            //     'message'=>'4 Digit OTP send Successfully',
            // ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'OTP send Failed'
            ]);
        }
    }
    
    public function verifyOTP(Request $request){
        $email = $request->input('email') ?? session('otp_email');
        $otp    = $request->input('otp');
        $count = User::where('email', '=', $email)
                     ->where('otp','=',$otp)
                     ->count();

                    if($count == 1){
                        //database update
                        User::where('email','=',$email)->update(['otp'=>'0']);
                        //create token for set password
                        $token = JWTToken::createTokenForSetPassword($email);
                        return response()
                                ->view('user.resetPass')
                                ->cookie('token', $token, 60, '/', null, false, true);

                        // return response()->json([
                        //     'status'=>'success',
                        //     'message'=>'Otp vefication successfully',
                        // ]);
                    }else{
                          return response()->json([
                            'status'=>'failed',
                            'message'=>'Otp vefication failed holo',
                        ]);
                    }
    }
    public function resetPassword(Request $request){       
        try{
            $email = $request->header('email');
            $password = $request->input('password');

            User::where('email',$email)
                ->update(['password'=>$password]);
            return response()->json([
                    'status'=>'success',
                    'message'=>'Password reset successfully',
            ]);
        }
        catch(Exception $e){
            return response()->json([
                    'status'=>'failed',
                    'message'=>$e->getMessage(),
            ]);
        }
        
    }
    public function userProfileData(Request $request){
        $email = $request->header('email');
        $user = User::where('email', $email)->first();
        return response()->json([
            'status'=>'success',
            'message'=>'success',
            'data'=>$user
        ]);
    }
    public function userProfileUpdate(Request $request){
        try{
            $email = $request->header('email');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $phone = $request->input('phone');
            $fax = $request->input('fax');
            $password = $request->input('password');

            User::where('email',$email)->update([
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'phone'=>$phone,
                'fax'=>$fax,
                'password'=>$password
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Profile Update Success'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getmessage()
            ]);
        }
        
    }
    public function userLogout(){
          return redirect('/')->cookie('token','',-1);
    }

}
