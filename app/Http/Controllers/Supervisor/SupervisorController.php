<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
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
               
    //     //  $password = password_hash($request->password, PASSWORD_DEFAULT);
    //      $supervisor = Supervisor::create([
    //         'email' => $request->email,
    //         'password' => $request->password
    //       ]);
      
    //       if(!$supervisor){
    //        return response()->json([
    //          'status' => false,
    //          'message' => 'Something went Wrong'
    //        ]);
    //       }else{
    //       return response()->json([
    //       'status' => true,
    //       'message' => 'Registered Supervisor Acc'
    //     //   'token' => $supervisor->createToken('supervisor')->accessToken
    //       ]);
    //       }
    //     }

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

    // $password = password_hash($request->password, PASSWORD_DEFAULT);
    // $password = password_verify($request->password, Supervisor::where('email', $request->email)->select('password'));
   $super = Supervisor::orderBy('created_at', 'desc')->where('email', $request->email)->where('password', $request->password)->get();
       if(!(count($super)==1)){
           return response()->json([
        'status' => false,
        'message' => 'invalid credential'
           ]);
       }else{
        //   $user = Auth::login($super[0]);
        // $success['token'] =  $user()->createToken('MyApp')->accessToken;
        return response()->json([
       'status' =>true,
       'token' => $super[0]->createToken('supervisor')->accessToken
        ]);
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
    public function show()
    {
      $supervisor =  Supervisor::find(Auth::id());
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
    public function update(Request $request)
    {
        $supervisor = Supervisor::find(Auth::id());
        if(!$supervisor){
            return response()->json([
        'status' => false,
        'message' => 'not found'
            ]);
        }else{
            if($request->image){
                $image = $this->saveImage($request->image, 'supervisor');
                $supervisor->image = $image;
                    }
            $supervisor->name = $request->name;
            $supervisor->phone_number = $request->phone_number;
            $supervisor->address = $request->address;
          $res = $supervisor->update();
           if($res){
            return response()->json([
               'status' => true,
               'message' => 'Update Successful'
            ]);
           }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    // public function destroy()
    // {
    //    $supervisor = Supervisor::find(Auth::id());
    //    if(!$supervisor){
    //     return response()->json([
    //       'status' => false,
    //       'message' => 'Not found'
    //     ]);
    //    }else{
    //     $res = $supervisor->delete();
    //     if(!$res){
    //       return response()->json([
    //       'status' => false,
    //       'message' => 'Something went Wrong'
    //       ]);
    //     }else{
    //     return response()->json([
    //     'status' => true,
    //     'message' => 'deleted'
    //     ]);            
    //     }
    //    }
    // }
}
