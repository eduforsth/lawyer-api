<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $note = Note::where('supervisor_id', $id)->get();
       return response()->json([
        'status' =>true,
        'data' => $note
       ]);
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
    public function store(Request $request, $id)
    {
        $note = new Note();
        $note->supervisor_id = $id;
        $note->case_id = $request->case_id;
        $note->lawyer_id = $request->lawyer_id;
        $note->client_id = $request->client_id;
        $note->note = $request->note;
        $note->alarm_time = $request->alarm_time;
       $res = $note->save();

        if(!$res){
            return response()->json([
                'status' => false,
                'message' => 'Something went Wrong'
            ]);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Created'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attrs = Validator($request->all(), [
         'note' => 'required',
         'alarm_time' => 'required',
        ]);

        if($attrs->fails()){
            return response()->json([
          'status' => false,
          'message' => $attrs->errors()
            ]);
        }

       $noteCase = Note::find($id);
       $noteCase->case_id = $request->case_id;
       $noteCase->lawyer_id = $request->lawyer_id;
       $noteCase->client_id = $request->client_id;
       $noteCase->note = $request->note;
       $noteCase->alarm_time = $request->alarm_time;
      $res = $noteCase->update();

       if(!$res){
        return response()->json([
          'status' => false,
          'message' => 'Something went Wrong'
        ]);
       }else{
       return response()->json([
        'status' => true,
        'data' => $noteCase
       ]);        
       }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
      $res = $note->delete();
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
