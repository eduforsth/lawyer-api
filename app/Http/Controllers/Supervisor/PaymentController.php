<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(){
       $payment = Payment::get();
       return response()->json([
        'status' => false,
        'data' => $payment
       ]);
    }

    public function store(Request $request){
        if(Auth::user() == null){
            return response()->json([
           'status' => false,
           'message' => 'Pls, login first!!'
            ]);
        }
       $attrs = Validator($request->all(), [
        // 'supervisor_id' => 'required',
        'payment_date' => 'required',
        'total_amount' => 'required',
        'valid_date' => 'required'
       ]);

       if($attrs->fails()){
        return response()->json([
         'status' => false,
         'message' => $attrs->errors()
        ]);
       }

       $payment = new Payment();
       $payment->supervisor_id = Auth::id();
       $payment->payment_date = $request->payment_date;
       $payment->total_amount = $request->total_amount;
       $payment->valid_date = $request->valid_date;
       
       $payment->save();

      if(!$payment){
        return response()->json([
        'status' => false,
        'message' => 'Something went Wrong'
        ]);
      }else{
        return response()->json([
          'status' => true,
          'message' => 'payment successful'
        ]);
      }

    }

    public function update(Request $request, $id){
        $attrs = Validator($request->all(), [
            // 'supervisor_id' => 'required',
            'payment_date' => 'required',
            'total_amount' => 'required',
            'valid_date' => 'required'
           ]);
    
           if($attrs->fails()){
            return response()->json([
             'status' => false,
             'message' => $attrs->errors()
            ]);
           }

       $payment = Payment::find($id);
       $payment->supervisor_id = Auth::id();
       $payment->payment_date = $request->payment_date;
       $payment->total_amount = $request->total_amount;
       $payment->valid_date = $request->valid_date;

      $res = $payment->update();

       if(!$res){
        return response()->json([
          'status' => false,
          'message' => 'something went Wrong'
        ]);
       }else{
        return response()->json([
          'status' => true,
          'message' => 'Update Successful'
        ]);
       }
    }

    public function delete($id){
       $payment = Payment::find($id);
       if(!$payment){
         return response()->json([
          'status' => false,
          'message' => 'Payment not found'
         ]);
       }else{
        $res = $payment->delete();
        if(!$res){
            return response()->json([
                'status' => false,
                 'message' => 'Delete Fail !!'
                 ]);
        }else{
           return response()->json([
          'status' => true,
           'message' => 'Deleted'
           ]);
        }

       }

    }
}
