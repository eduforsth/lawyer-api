<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function register(Request $request){
        $attrs = validator::make($request->all(), [
             'email' => 'required',
             'password' => 'required'
         ]);
     
         if($attrs->fails()){
             return response()->json([
              'status' =>false,
              'message' => 'Invalid Credential'
             ]);
         }

        //  if(Admin::attempt($attrs)){
        //     return response()->json([
        // 'status' => false,
        // 'message' => 'already created'
        //     ], 500);
        // 
         $admin = Admin::create([
           'email' => $request->email,
           'password' => $request->password
         ]);
     
         return response()->json([
         'status' => $admin,
         'data' => $admin->createToken('admin')->accessToken
         ]);
        }

        public function login(Request $request){
            $attrs = Validator($request->all(), [
                 'email' => 'required',
                 'password' => 'required'
             ]);
         
             if($attrs->fails()){
                 return response()->json([
                  'status' =>false,
                  'message' => $attrs->errors()
                 ]);
             }

         $admin = Admin::where('email', $request->email)->first();
            //   if(Auth::attempt(['email'=> $request->name, 'password'=>$request->password])){
             
            if($admin){
              if($request->password != $admin->password){
                return response()->json([
              'status' => false,
              'message' => 'check password'
                ]);
              }else{
                // $user = Auth::user();
                return response()->json([
                'status' => true,
                'data' => $admin,
                  'token' => $admin->createToken('admin')->accessToken
                ]);                
              }

              }else{
              return response()->json([
                 'status' => false,
                 'message' => 'login fail'
              ]);  
              }  
            }

            public function destroy($id){
            $admin = Admin::find($id);
           $res = $admin->delete();
            if($res){
           return response()->json([
           'status' => true,
           'message' => 'deleted'
           ], 200);
            }
            }
}
