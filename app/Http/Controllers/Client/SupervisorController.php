<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
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

}
