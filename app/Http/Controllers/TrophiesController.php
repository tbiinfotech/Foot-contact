<?php

namespace App\Http\Controllers;

use App\Models\Trophies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dotenv\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TrophiesController extends Controller
{
    // index page
    public function index()
    {
        try {
            $search = request()->get('search');
            $id = Auth::user()->id;
            $data = Trophies::where(['club_id' => $id, 'status' => 1]);
            if (isset($search)) {
                $data = $data->where('name', 'LIKE', "%{$search}%");
            }
            $data = $data->orderBy('id', 'DESC')->paginate(10);
            return view('trophy.index', ['data' => $data]);
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
                'name' => 'required',
                'image' => 'required'
            ]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput();
              }
            
            if ($request->hasFile('image')) { 
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            $data = Trophies::create([
                'name' => $request['name'],
                'image' => $filename,
                'club_id' => $id,
                'status' => 1,
            ]);
            return redirect('trophy-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = Trophies::find($id);
            return view('trophy.view', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    //update status
    public function status()
    {
        try {
            $id = request()->get('id');
            $data = Trophies::where('id', $id)->update(['status' => 0]);
            return view('trophy.view', ['data' => $data]);
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
            $data = Trophies::find($id)->delete();
            return redirect('trophy-index');
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
            $data = Trophies::find($id);
            
            return view('trophy.edit', ['id' => $id,'data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * update
     */
    public function update(Request $request, $id)
    {
        // try {
           
            $validator = FacadesValidator::make($request->all(), [
                'name' => 'required',
                'image' => 'required'
               
            ]);
            if($validator->fails()){
                return back()->withErrors($validator->errors())->withInput();
              }
              if ($request->hasFile('image')) { 
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            }
            $data =  Trophies::where('id', $id)->update([
                'name' => $request->name,
                'image' => $filename
            ]);
            return redirect('trophy-index');
        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage());
        // }
    }
}
