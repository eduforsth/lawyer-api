<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
        public function login(Request $request){
          // return response()->json([ 'valid' => auth()->check() ]);
       $attrs = validator($request->all(), [
           'email' => 'required|email',
           'password' => 'required|min:6'
       ]);

       if($attrs->fails()){
        return response()->json([
            'status' => false,
            'message' => $attrs->errors()
        ]);
       }

        // $credentials = $request->only('email', 'password');
    //    if(!Auth::attempt(['name'=> $request->name, 'email' => $request->email, 'password' => $request->password])){

    // $password = password_hash($request->password, PASSWORD_DEFAULT);
    // $password = password_verify($request->password, Supervisor::where('email', $request->email)->select('password'));
   $lawyer = Lawyer::orderBy('created_at', 'desc')->where('email', $request->email)->first();
       if(!$lawyer){
           return response()->json([
        'status' => false,
        'message' => 'invalid credential'
           ]);
       }else{
        // $user = Auth::guard('admin')->user();
        // $success['token'] =  $user()->createToken('MyApp')->accessToken;
        return response()->json([
       'status' =>true,
       'data' => $lawyer,
       'token' => $lawyer->createToken('lawyer')->accessToken
        ]);
       }
        }
  
}
