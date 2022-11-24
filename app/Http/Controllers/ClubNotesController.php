<?php

namespace App\Http\Controllers;

use App\Models\ClubNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dotenv\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ClubNotesController extends Controller
{
    //
    // index page
    public function index()
    {
        try {
            $auth_user = Auth::user()->id; 
            $data = ClubNotes::where(['user_id' => $auth_user])->orderBy('id', 'DESC')->paginate(10);
            return view('clubNotes.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // add
    public function add(Request $request)
    {
        try {
            $id = Auth::user()->id;
            $validator = FacadesValidator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required'
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
            $data = ClubNotes::create([
                'title' => $request['title'],
                'image' => $filename,
                'user_id' => $id,
                'description' => $request['description'],
                'status' => 0, //enable
            ]);
            return redirect('club-notes-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = ClubNotes::find($id);
            return view('clubNotes.view', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    //update status
    public function status()
    {
        try {
            $id = request()->get('id');
            $clubnotes = ClubNotes::where('id', $id)->first();
            $club = ClubNotes::where('id', $id);
            if ($clubnotes->status == 0) {
                $club->update([
                    'status' => 1
                ]);
            } else {
                $club->update([
                    'status' => 0
                ]);
            }
            return redirect('club-notes-index');
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
            $data = ClubNotes::find($id)->delete();
            return redirect('club-notes-index');
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
            $data = ClubNotes::find($id);

            return view('clubNotes.edit', ['id' => $id, 'data' => $data]);
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
        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
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
        } else {
            $Userinfo = ClubNotes::where('id', $id)->first();
            $filename = $Userinfo->image;
        }
        $data =  ClubNotes::where('id', $id)->update([
            'title' => $request['title'],
            'image' => $filename,
            'description' => $request['description'],
        ]);
        return redirect('club-notes-index');     
            } catch (\Exception $e) {
            return $this->error($e->getMessage());
        } 
    }
    // Import
    public function input()
    {
        try {
            return view('clubNotes.import');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * import
     */
    public function import(Request $request)
    {
        // try {
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
                $title =  isset($getData[0]) ? $getData[0] : '';
                $description = isset($getData[1]) ? $getData[1] : '';
                $status = isset($getData[2]) ? $getData[2] : '';
                $user_id = Auth::user()->id;
                $data = ClubNotes::create([
                    'title' => $title,
                    'description' => $description,
                    'status' => $status,
                    'user_id' => $user_id,
                ]);
            }
            return redirect('club-notes-index');
        // } catch (\Exception $e) {

        //     return $this->error($e->getMessage());
        // }
    }
    /**
     * export
     */
    public function export()
    {
        try {
            $name = "fc-club-notes" . date('Ymd') . ".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Pragma: no-cache");
            header("Expires: 0");

            $clubs = ClubNotes::get();;
            $columns = array('title', 'description', 'status');

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($clubs as $club) {
                fputcsv($file, array($club->title, $club->description, $club->status));
            }
            exit();
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}
