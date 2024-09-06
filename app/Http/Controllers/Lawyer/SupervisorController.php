<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lawyer;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
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

            public function getLawyers($id){
                   $lawyer = Lawyer::where('supervisor_id', $id)->get();
              //   $supervisor =  Supervisor::find(Auth::id());
                  return response()->json([
               'status' => true,
               'data' => $lawyer
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
