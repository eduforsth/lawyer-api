<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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
     'data' => $client[0],
     'token' => $client[0]->createToken('client')->accessToken
      ]);
      }
      
     }
      }

    public function show()
    {
      $client =  Client::find(Auth::id());
      if($client){
        // $res = $superviser->with('lawyers')->get();
        // $res = $superviser;
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
    public function update(Request $request)
    {
        $client = Client::find(Auth::id());
        if(!$client){
            return response()->json([
        'status' => false,
        'message' => 'not found'
            ]);
        }else{
            if($request->image){
                $image = $this->saveImage($request->image, 'supervisor');
                $client->image = $image;
                    }
            $client->name = $request->name;
            $client->phone_number = $request->phone_number;
            $client->address = $request->address;
          $res = $client->update();
           if($res){
            return response()->json([
               'status' => true,
               'message' => 'Update Successful'
            ]);
           }
        }
    }

}
