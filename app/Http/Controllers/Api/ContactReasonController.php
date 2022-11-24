<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactReasonController extends Controller
{
    // 
     /**
     * get list
     */

    public function reason_list()
    {
       try {
            $datas = DB::table('contact_reason')->get();
            $list=[];
            foreach($datas as $data)
            {
                $a['id']=$data->id;
                $a['title']=$data->title;
                $a['description']=$data->description;
                $a['status']=$data->status;
                $a['is_check']=false;
                $list[]=$a;
            } 
            $response = ['data' => $list];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
     /**
     * send email
     */
    public function contact_reason(Request $request)
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $reason =$data['reason']; 
            $description = $data['description'];
            $email = Auth::user()->email;
            $response = ['message' => "Email Sent"];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
       
    }
}
