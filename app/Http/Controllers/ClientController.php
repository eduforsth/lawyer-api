<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // public function register(Request $request){
    //     $attrs = Validator($request->all(), [
    //          'email' => 'required|email',
    //          'password' => 'required|min:6'
    //      ]);
     
    //      if($attrs->fails()){
    //          return response()->json([
    //           'status' =>false,
    //           'message' => $attrs->errors()
    //          ]);
    //      }

    //      $isClient = Client::where('email', $request->email)->where('password', $request->password)->get();
    //      if(count($isClient)>0){
    //        return response()->json([
    //     'status' => false,
    //     'message' => 'invalid credential'
    //        ]);
    //      }
    //     //  $password = password_hash($request->password, PASSWORD_DEFAULT);
    //      $client = Client::create([
    //         'supervisor_id' => Auth::id(),
    //         'lawyer_id' => 0,
    //         'email' => $request->email,
    //         'password' => $request->password
    //       ]);

    //       if(!$client){
    //         return response()->json([
    //          'status' => false,
    //          'message' => 'Something went Wrong'
    //         ]);
    //       }else{
    //       return response()->json([
    //       'status' => true,
    //     //   'messate' => 'Register Success!!'
    //        'token' => $client->createToken('client')->accessToken
    //       ]);            
    //       }
    //     }

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
     $client = Client::orderBy('created_at', 'desc')->where('email', $request->email)->get();
         if(!(count($client)==1)){
             return response()->json([
          'status' => false,
          'message' => 'invalid credential'
             ]);
         }else{
         $password = password_verify($request->password, $client[0]->password);
          if(!$password){
            return response()->json([
                'status' => false,
                'message' => 'wrong password'
                   ]);
          }else{
          return response()->json([
         'status' =>true,
         'data' => $client[0]->createToken('client')->accessToken
          ]);
          }
          
         }
          }

  
}
