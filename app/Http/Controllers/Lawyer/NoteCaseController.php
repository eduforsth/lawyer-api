<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use App\Models\NoteCase;
use Illuminate\Http\Request;

class NoteCaseController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $noteCases = NoteCase::where('supervisor_id', $id)->get();
        return response()->json([
      'status' => true,
      'data' => $noteCases
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
    public function store(Request $request)
    {
      $attrs = Validator($request->all(), [
        'client_name' => 'required',
       ]);

       if($attrs->fails()){
           return response()->json([
         'status' => false,
         'message' => $attrs->errors()
           ]);
       }

        $case = new NoteCase();
        $case->supervisor_id = $request->supervisor_id;
        $case->lawyer_id = $request->lawyer_id;
         $case->client_id = $request->client_id;
        $case->client_name = $request->client_name;
        $case->case_name = $request->case_name;
        $case->case_no = $request->case_no;
        $case->court_name = $request->court_name;
        $case->tayalo_name = $request->tayalo_name;
        $case->tayakhan_name = $request->tayakhan_name;
        $case->tayalo_lawyer_name = $request->tayalo_lawyer_name;
        $case->tayakhan_lawyer_name = $request->tayakhan_lawyer_name;
        $case->case_accepted_date = $request->case_accepted_date;
        $case->next_hearing_date = $request->next_hearing_date;
        $case->save();

        if($case){
            return response()->json([
                'status' => true,
                'message' => 'Created'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NoteCase  $noteCase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noteCases = NoteCase::where('id', $id)->first();
          
        if(!$noteCases){
          return response()->json([
            'status' => false,
            'message' => 'Not Found'
          ]);
        }else{
        return response()->json([
        'status' => true,
        'data' => $noteCases
          ]);            
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoteCase  $noteCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attrs = Validator($request->all(), [
         'client_name' => 'required',
        ]);

        if($attrs->fails()){
            return response()->json([
          'status' => false,
          'message' => $attrs->errors()
            ]);
        }

       $noteCase = NoteCase::find($id);
       $noteCase->client_name = $request->client_name;
       $noteCase->case_name = $request->case_name;
       $noteCase->case_no = $request->case_no;
       $noteCase->court_name = $request->court_name;
       $noteCase->tayalo_name = $request->tayalo_name;
       $noteCase->tayakhan_name = $request->tayakhan_name;
       $noteCase->tayalo_lawyer_name = $request->tayalo_lawyer_name;
       $noteCase->tayakhan_lawyer_name = $request->tayakhan_lawyer_name;
       $noteCase->case_accepted_date = $request->case_accepted_date;
       $noteCase->next_hearing_date = $request->next_hearing_date;
       $noteCase->alarm = $request->alarm;
      $res = $noteCase->update();

      if(!$res){
        return response()->json([
            'status' => $res,
            'message' => 'Something went wrong !!'
           ]);
      }else{
        return response()->json([
            'status' => $res,
            'message' => 'Updated'
           ]);
      }
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoteCase  $noteCase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $noteCase = NoteCase::find($id);
       if(!$noteCase){
         return response()->json([
         'status' => false,
         'message' => 'Not found'
         ]);
       }
      $res = $noteCase->delete();
       if($res){
        return response()->json([
           'status' => true,
           'message' => 'deleted'
        ]);
       }
    }
}
