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
    public function store(Request $request, $id)
    {
        $case = new NoteCase();
        $case->supervisor_id = $id;
        // $case->lawyer_id = $request->lawyer_id;
        // $case->client_id = $request->client_id;
        $case->client_name = $request->client_name;
        $case->court_name = $request->court_name;
        $case->case_name = $request->case_name;
        $case->previous_hearing_date = $request->previous_hearing_date;
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoteCase  $noteCase
     * @return \Illuminate\Http\Response
     */
    public function edit(NoteCase $noteCase)
    {
        //
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
         'court_name' => 'required',
        //  'judge_name' => 'required',
         'case_name' => 'required',
        //  'case_no' => 'required',
        //  'case_year' => 'required',
        //  'other_party_name' => 'required',
        //  'opposite_advocate_name' => 'required',
         'previous_hearing_date' => 'required',
        //  'next_hearing_date' => 'required',
        //  'case_accepted_date' => 'required',
        ]);

        if($attrs->fails()){
            return response()->json([
          'status' => false,
          'message' => $attrs->errors()
            ]);
        }

       $noteCase = NoteCase::find($id);
       $noteCase->client_name = $request->client_name;
       $noteCase->court_name = $request->court_name;
       $noteCase->judge_name = $request->judge_name;
       $noteCase->case_name = $request->case_name;
       $noteCase->case_no = $request->case_no;
       $noteCase->case_year = $request->case_year;
       $noteCase->other_party_name = $request->other_party_name;
       $noteCase->opposite_advocate_name = $request->opposite_advocate_name;
       $noteCase->previous_hearing_date = $request->previous_hearing_date;
       $noteCase->next_hearing_date = $request->next_hearing_date;
       $noteCase->case_accepted_date = $request->case_accepted_date;
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
