<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawyerController extends Controller
{
    public function register(Request $request){
      return 'hello';
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

         $isLawyer = Lawyer::where('email', $request->email)->get();
   $password = password_verify($request->password, $isLawyer[0]->password);
         
         if(count($isLawyer)>0 && !$password){
           return response()->json([
        'status' => false,
        'message' => 'invalid credential'
           ]);
         }
        //  $password = password_hash($request->password, PASSWORD_DEFAULT);
         $lawyer = Lawyer::create([
            'supervisor_id' => Auth::id(),
            'email' => $request->email,
            'password' => $request->password
          ]);

          if(!$lawyer){
           return response()->json([
            'status' =>false,
            'message' => 'Fail create'
           ]);
          }else{
          return response()->json([
          'status' => true,
           'message' => 'created lawyer'
        //   'token' => $lawyer->createToken('lawyer')->accessToken
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $lawyer =  Lawyer::find($id);
      if(!$lawyer){
        return response()->json([
    'status' => false,
    'data' => 'Lawyer Not Found!'
        ]);
       }else{
        return response()->json([
       'status' => true,
       'data' => $lawyer
        ]);
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Lawyer $supervisor)
    {
        //
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

    $lawyer = Lawyer::find($id);
    if(!$lawyer){
      return response()->json([
       'status' => false,
       'message' => 'Not found'
      ]);
    }
    $lawyer->name = $request->name;
    $lawyer->phone_number = $request->phone_number;
    $lawyer->address = $request->address;
   $res = $lawyer->update();

   if(!$res){
    return response()->json([
     'status' =>false,
     'message' => 'Fail Update'
    ]);
   }else{
   return response()->json([
   'status' => true,
    'message' => 'Updated lawyer'
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
      $lawyer = Lawyer::find($id);
      if(!$lawyer){
        return response()->json([
           'status' => false,
           'message' => 'Not Found'
        ]);
      }

      $res = $lawyer->delete();
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
