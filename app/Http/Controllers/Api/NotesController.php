<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
 /**
     * create notes
     */
    public function create_notes(Request $request)
    { 
        try {
            $request = json_decode(file_get_contents("php://input"), true);
            $description = $request['description']; 
            $event_id = $request['event_id'];
            $type_id = $request['type_id'];
            $user_id =   Auth::user()->id;
            $data = Notes::create([
                'description' => $description,
                'user_id' => $user_id,
                'event_id'=>$event_id,
                'type_id'=>$type_id 
            ]);
            return response()->json([
                'success' => true,
                'data' => $data, 
                'message' => 'Note Created'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not saved'
            ], 400);
        }
    }
    /**
     * edit notes
     */
    public function edit_notes(Request $request, $id)
    {
        try {
            $request = json_decode(file_get_contents("php://input"), true);
            $description = $request['description'];
            $data = Notes::where(['id' => $id])->update([
                'description' => $description
            ]);
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Note Edit'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not saved'
            ], 400);
        }
    }
     /**
     * delete notes
     */
    public function delete_notes($id)
    {
        try {
            Notes::where(['id' => $id])->delete();
            return response()->json([
                'success' => true,
                'message' => 'Note Delete'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not saved'
            ], 400);
        }
    }
     /**
     * delete notes
     */
    public function get_notes($event_id,$type_id)
    {
        try {
            $user_id =   Auth::user()->id;
            $data = Notes::where(['user_id'=>$user_id,'event_id'=>$event_id,'type_id'=>$type_id])->orderBy('id', 'DESC')->get();
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Note Created'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data not saved'
            ], 400);
        }
    }
}
