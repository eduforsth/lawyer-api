<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{

        public function login(Request $request){
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

   $super = Supervisor::orderBy('created_at', 'desc')->where('email', $request->email)->get();
       
   if(!(count($super)==1)){
           return response()->json([
        'status' => false,
        'message' => 'invalid credential'
           ]);
       }else{
   $password = password_verify($request->password, $super[0]->password);
        if(!$password){
            return response()->json([
                'status' => false,
                'message' => 'Wrong Password'
                   ]);
        }else{
return response()->json([
       'status' =>true,
       'data' => $super[0],
       'token' => $super[0]->createToken('supervisor')->accessToken
        ]);            
        }
        
       }
        }

        public function getLawyers(){
        //    return response()->json([
        //     'sss'=>true
        //    ]);
            // $user = ;
             $lawyers = Lawyer::where('supervisor_id', Auth::id())->get();
        //   $supervisor =  Supervisor::find(Auth::id());
            return response()->json([
         'status' => true,
         'data' => $lawyers
        //  'data' => $use
            ]);
        }

        public function getClients(){
            //    return response()->json([
            //     'sss'=>true
            //    ]);
                // $user = ;
                 $client = Client::where('supervisor_id', Auth::id())->get();
            //   $supervisor =  Supervisor::find(Auth::id());
                return response()->json([
             'status' => true,
             'data' => $client
            //  'data' => $use
                ]);
            }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $superviser = Supervisor::get();
       if(count($superviser)>0){
        return response()->json([
    'status' => true,
    'data' => $superviser
        ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $supervisor =  Supervisor::find($id);
      if($supervisor){
        // $res = $superviser->with('lawyers')->get();
        // $res = $superviser;
        return response()->json([
        'status' => true,
        'data' => $supervisor
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
    public function update(Request $request, Supervisor $supervisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $supervisor = Supervisor::find($id);
       if(!$supervisor){
        return response()->json([
          'status' => false,
          'message' => 'Not found'
        ]);
       }else{
        $res = $supervisor->delete();
        if(!$res){
          return response()->json([
          'status' => false,
          'message' => 'Something went Wrong'
          ]);
        }else{
        return response()->json([
        'status' => true,
        'message' => 'deleted'
        ]);            
        }
        

       }
    }
}
