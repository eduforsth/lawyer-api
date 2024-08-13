<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supervisor  $supervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(Supervisor $supervisor)
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
