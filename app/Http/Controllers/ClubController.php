<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Club;
use App\Models\ClubInfo;
use App\Models\CoachGroup;
use App\Models\Group;
use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Mail;


class ClubController extends Controller
{
    // index page
    public function index()
    {
        try {
            $data = User::where(['role_id' => 2])->orderBy('id', 'DESC')->paginate(10);
            return view('club.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // index page
    public function add()
    {
        try {
            $clubInfoId = User::whereNotNull('club_info_id')->pluck('club_info_id')->toArray();
            $clubs = ClubInfo::whereNotIn('id', $clubInfoId)->get();
            return view('club.add', ['clubs' => $clubs]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // add
    public function create(Request $request)
    {
        try {
            $filename = '';
            $validator = FacadesValidator::make($request->all(), [
                'club_info_id' => 'required',
                'image' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|unique:users|digits:10',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            //random string
            $length = 15;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'image' => $filename,
                'email' => $request['email'],
                'password' => Hash::make($randomString),
                'reset_token' => $randomString,
                'club_info_id' => $request['club_info_id'],
                'created_by_id' => Auth::user()->id,
                'role_id' => '2',

            ]);
            //send mail 
            $details = [
                'reset_token' => $user->reset_token,
                'email' => $user->email,
                'title' => 'Mail from Online Web Tutor',
                'body' => 'Test mail sent by Laravel 8 using SMTP.'
            ];
            Mail::to($user->email)->send(new \App\Mail\ResetMail($details));
            return redirect('club-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * edit
     */
    public function edit()
    {
        try {
            $role_id = Auth::user()->role_id;
            if ($role_id == '2') {
                $id = Auth::user()->id;
            } else {
                $id = request()->get('id');
            }
            $user_detail = User::find($id);
            $club_detail = Club::where('user_id', $id)->first();
            $clubs = ClubInfo::get();
            return view('club.edit', [
                'club_detail' => $club_detail,
                'user_detail' => $user_detail,
                'id' => $id,
                'role_id' => $role_id,
                'clubs' => $clubs
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * update
     */
    public function update(Request $request, $id)
    {
        try {
        $role_id = Auth::user()->role_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $filename = time() . $file;
            $path = public_path('/Uploads');
            $file = $request->file('image');
            $file->move($path, $filename);
        } else {
            $Userinfo = User::where('id', $id)->first();
            $filename = $Userinfo->image;
        }
        $data =  User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'club_info_id' => $request->club_info_id,
            'email' =>  $request->email,
            'image' => $filename

        ]);

        return redirect('club-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * update_club
     */
    public function update_club()
    {
        try {
            $id = request()->get('id');
            $first_name = request()->get('first_name');
            $last_name = request()->get('last_name');

            $data =  User::where('id', $id)->update(['first_name' => $first_name, 'last_name' => $last_name]);
            return response()->json([
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Delete  
     */
    public function delete()
    {
        try {
            $id = request()->get('id');
            $data = User::find($id)->delete();
            $club =  DB::table('clubs')->where('user_id', $id)->delete();
            return redirect('club-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * club view
     */
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = User::find($id);
            return view('club.view', [
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * export
     */
    public function export()
    {
        try {
            $name = "fc-club-" . date('Ymd') . ".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");
            $clubs = User::where(['role_id' => 2])->get();;
            $columns = array('Name', 'email', 'phone');
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($clubs as $club) {
                fputcsv($file, array($club->first_name . ' ' . $club->last_name, $club->email, $club->phone));
            }
            exit();
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    // Import
    public function input()
    {
        try {
            return view('club.import');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * import
     */
    public function import(Request $request)
    {
        try {
            set_time_limit(0);
            $validator = FacadesValidator::make($request->all(), [
                "image" => "required|mimes:csv|max:10000"
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            $file = "http://15.188.226.196/public/" . "/Uploads/" . $filename;
            $handle = fopen($file, "rb");

            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $name =  isset($getData[0]) ? $getData[0] : '';
                $email = isset($getData[1]) ? $getData[1] : '';
                $phone = isset($getData[2]) ? $getData[2] : '';
                $role_id = 2;
                $pieces = explode(" ", $name);
                $exist = User::where('phone', '=', $phone)->orWhere('email', '=', $email)->first();
                if (empty($exist)) {
                    $data = User::create([
                        'name' => $name,
                        'email' => $email,
                        'first_name' => isset($pieces[0]) ? $pieces[0] : "",
                        'last_name' => isset($pieces[1]) ? $pieces[1] : "",
                        'phone' => $phone,
                        'role_id' => $role_id
                    ]);
                }
            }
            return redirect('club-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    /**
     * club detail
     */
    public function detail()
    {
        try {
            $id = request()->get('id');
            $data = User::find($id);
            $response = [
                'data' => $data

            ];
            return response()->json([
                'success' => true,
                'response' => $response
            ], 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
