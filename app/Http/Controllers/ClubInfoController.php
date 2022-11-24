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

class ClubInfoController extends Controller
{
    //
    public function index()
    {
        try {
            $data = ClubInfo::orderBy('id', 'DESC')->paginate(10);
            return view('clubInfo.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // index page
    public function add()
    {
        try {
            return view('clubInfo.add');
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
            'name' => 'required',
            'logo' => 'required',
            'president' => 'required',
            'official_id_number' => 'required|numeric',
            'city' => 'required', 
            'postal_code' => 'required|numeric',
            'official_email' => 'unique:clubs|required|string|email',
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        if ($request->hasFile('logo')) {
            $file = $request->file('logo')->getClientOriginalName();
            $filename = time() . $file;
            $path = public_path('/Uploads');
            $file = $request->file('logo'); 
            $file->move($path, $filename);
        }
        $user = ClubInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request['name'], 
            'logo' => $filename,
            'president' => $request['president'],
            'official_id_number' => $request['official_id_number'],
            'main_address' => $request['main_address'],
            'city' => $request['city'],
            'postal_code' => $request['postal_code'],
            'official_email' => $request['official_email'],
            'contact_email' => $request['contact_email'],
            'website_url' => $request['website_url'],
            'federation_page_link' => $request['federation_page_link'],
            'facebook' => $request['facebook'],
            'instagram' => $request['instagram'],
            'twitter' => $request['twitter'],
            'premises_address' => $request['premises_address'],
            'premises_field_type' => $request['premises_field_type'],
            

        ]);


        return redirect('club-info-index');
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
            $id = request()->get('id');
            $club_detail = ClubInfo::where('id', $id)->first();
            return view('clubInfo.edit', ['club_detail' => $club_detail,'id'=>$id]);
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
        if ($request->hasFile('logo')) {
            $file = $request->file('logo')->getClientOriginalName();
            $filename = time() . $file;
            $path = public_path('/Uploads');
            $file = $request->file('logo'); 
            $file->move($path, $filename); 
        }else{
            $clubinfo= ClubInfo::where('id', $id)->first();
            $filename=$clubinfo->logo;
        }
            $club =  ClubInfo::where('id', $id)->update([
                'user_id' => Auth::user()->id,
                'name' => $request->club_name,
                'logo' => $filename,
                'president' => $request->president,
                'official_id_number' =>$request->official_id_number,
                'city' => $request->city,
                'main_address' => $request['main_address'],
                'postal_code' => $request->postal_code, 
                'official_email' => $request->official_email,
                'contact_email' => $request->contact_email,
                'website_url' => $request->website_url,
                'federation_page_link' => $request->federation_page_link,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'premises_address' => $request->premises_address,
                'premises_field_type' => $request->premises_field_type,
            ]);
            return redirect('club-info-index');
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
            $data = ClubInfo::find($id)->delete();
            $club =  DB::table('clubs')->where('user_id', $id)->delete();
            return redirect('club-info-index');
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
            $data = ClubInfo::find($id);

            return view('clubInfo.view', [
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
            $name = "fc-clubInfo-" . date('Ymd') . ".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");
            $clubs = ClubInfo::get();;
            $columns = array(
              'Name', 'President', 'Official Id Number', 'Main Address', 'City',
                'Postal Code', 'City', 'official_email', 'contact_email', 'website_url', 'federation_page_link',
                'facebook', 'instagram', 'twitter', 'premises_address', 'premises_field_type'
            );
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($clubs as $club) {
                fputcsv($file, array(
                   $club->name, $club->president, $club->official_id_number, $club->main_address, $club->city, $club->postal_code, $club->official_email, $club->contact_email,
                    $club->website_url, $club->federation_page_link, $club->facebook, $club->instagram,
                    $club->twitter, $club->premises_address, $club->premises_field_type
                ));
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
            return view('clubInfo.import');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * import
     */
    public function import(Request $request)
    {
        //   try {
        set_time_limit(0);
        $validator = FacadesValidator::make($request->all(), [
     //       "image" => "required|mimes:csv|max:10000"
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
            $president = isset($getData[1]) ? $getData[1] : '';
            $official_id_number = isset($getData[2]) ? $getData[2] : '';
            $main_address =  isset($getData[3]) ? $getData[3] : '';
            $city = isset($getData[4]) ? $getData[4] : '';
            $postal_code = isset($getData[5]) ? $getData[5] : '';
            $official_email =  isset($getData[6]) ? $getData[6] : '';
            $contact_email = isset($getData[7]) ? $getData[7] : '';
            $website_url = isset($getData[8]) ? $getData[8] : '';
            $federation_page_link = isset($getData[9]) ? $getData[9] : '';
            $facebook =  isset($getData[10]) ? $getData[10] : '';
            $instagram = isset($getData[11]) ? $getData[11] : '';
            $twitter = isset($getData[12]) ? $getData[12] : '';
            $premises_address = isset($getData[13]) ? $getData[13] : '';
            $premises_field_type = isset($getData[14]) ? $getData[14] : '';
            $exist = ClubInfo::where('official_id_number', '=', $official_id_number)->first();
            if (empty($exist)) {
                $data = ClubInfo::create([
                    'name' => $name,
                    'user_id' =>auth()->user()->id,
                    'president' => $president,
                    'official_id_number' => $official_id_number,
                    'main_address' => $main_address,
                    'city' => $city,
                    'postal_code' => $postal_code,
                    'official_email' => $official_email,
                    'contact_email' => $contact_email,
                    'website_url' => $website_url,
                    'federation_page_link' => $federation_page_link,
                    'facebook' =>  $facebook,
                    'instagram' => $instagram,
                    'twitter' => $twitter ,
                    'premises_address' => $premises_address,
                    'premises_field_type' => $premises_field_type,
        
                ]);
            }
          
        }
        return redirect('club-info-index');
        // } catch (\Exception $e) {

        //     return $this->error($e->getMessage());
        // }
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
