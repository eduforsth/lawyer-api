<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function register(Request $request){
        $attrs = Validator($request->all(), [
             'email' => 'required|email',
             'password' => 'required|min:6'
         ]);
     
         if($attrs->fails()){
             return response()->json([
              'status' =>false,
              'message' => $attrs->errors()
             ]);
         }
         
         $isClient = Client::where('email', $request->email)->get();
         if(count($isClient)>0){

           return response()->json([
        'status' => false,
        'message' => 'invalid credential'
           ]);
         }
          $password = password_hash($request->password, PASSWORD_DEFAULT);
         $client = Client::create([
            'supervisor_id' => Auth::id(),
            'lawyer_id' => 0,
            'email' => $request->email,
            'password' => $password
          ]);

          if(!$client){
            return response()->json([
             'status' => false,
             'message' => 'Something went Wrong'
            ]);
          }else{
          return response()->json([
          'status' => true,
          'message' => 'Register Success!!'
        //    'token' => $client->createToken('client')->accessToken
          ]);            
          }
        }

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
     $client = Client::orderBy('created_at', 'desc')->where('email', $request->email)->where('password', $request->password)->get();
         if(!(count($client)==1)){
             return response()->json([
          'status' => false,
          'message' => 'invalid credential'
             ]);
         }else{
          // $user = Auth::guard('admin')->user();
          // $success['token'] =  $user()->createToken('MyApp')->accessToken;
          return response()->json([
         'status' =>true,
         'data' => $client[0]->createToken('client')->accessToken
          ]);
         }
          }

          public function show($id)
          {
            $client =  Client::find($id);
            if(!$client){
              return response()->json([
          'status' => false,
          'data' => 'client Not Found!'
              ]);
             }else{
              return response()->json([
             'status' => true,
             'data' => $client
              ]);
             }
          }
      
          /**
           * Update the specified resource in storage.
           *
           * @param  \Illuminate\Http\Request  $request
           * @param  \App\Models\Supervisor  $supervisor
           * @return \Illuminate\Http\Response
           */
          public function update(Request $request, $id)
          {
            $attrs = Validator($request->all(), [
              'name' => 'required',
              'phone_number' => 'required',
              'address' => 'required',
          ]);
      
          if($attrs->fails()){
              return response()->json([
               'status' =>false,
               'message' => $attrs->errors()
              ]);
          }
      
          $lawyer = Client::find($id);
          if(!$lawyer){
            return response()->json([
             'status' => false,
             'message' => 'Not found'
            ]);
          }
          $client->name = $request->name;
          $client->phone_number = $request->phone_number;
          $client->address = $request->address;
         $res = $client->update();
      
         if(!$res){
          return response()->json([
           'status' =>false,
           'message' => 'Fail Update'
          ]);
         }else{
         return response()->json([
         'status' => true,
          'message' => 'Updated client'
       //   'token' => $lawyer->createToken('lawyer')->accessToken
         ]);            
         }
      
          }
      
          /**
           * Remove the specified resource from storage.
           *
           * @param  \App\Models\Supervisor  $supervisor
           * @return \Illuminate\Http\Response
           */
          public function destroy($id)
          {
            $client = Client::find($id);
            if(!$client){
              return response()->json([
                 'status' => false,
                 'message' => 'Not Found'
              ]);
            }
      
            $res = $client->delete();
            if(!$res){
              return response()->json([
                  'status' => false,
                  'message' => 'Something went Wrong'
               ]);
            }else{
              return response()->json([
                  'status' => true,
                  'message' => 'Deleted'
               ]);
            }
          }
}
