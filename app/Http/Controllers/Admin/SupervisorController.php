<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
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
        // $password = bcrypt($request->password);

          $password = password_hash($request->password, PASSWORD_DEFAULT);
         $supervisor = Supervisor::create([
            'email' => $request->email,
            // 'password' => $request->password
            'password' => $password
          ]);
      
          if(!$supervisor){
           return response()->json([
             'status' => false,
             'message' => 'Something went Wrong'
           ]);
          }else{
          return response()->json([
          'status' => true,
          'message' => 'Registered Supervisor Acc'
        //   'token' => $supervisor->createToken('supervisor')->accessToken
          ]);
          }

        }

    

        public function getLawyers($id){
        //    return response()->json([
        //     'sss'=>true
        //    ]);
            // $user = ;
             $lawyers = Lawyer::where('supervisor_id', $id)->get();
        //   $supervisor =  Supervisor::find(Auth::id());
            return response()->json([
         'status' => true,
         'data' => $lawyers
        //  'data' => $use
            ]);
        }

        public function getClients($id){
            //    return response()->json([
            //     'sss'=>true
            //    ]);
                // $user = ;
                 $client = Client::where('supervisor_id', $id)->get();
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
       $supervisor = Supervisor::get();
       if(count($supervisor)>0){
        return response()->json([
    'status' => true,
    'data' => $supervisor
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
        // $password = password_verify('123456', $supervisor->password);
        return response()->json([
        'status' => true,
        // 'password' => $password,
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
