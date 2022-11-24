<?php

namespace App\Http\Controllers;

use App\Models\SportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class SportCategoryController extends Controller
{

    // index page
    public function index()
    {
        try {
            $data = SportCategory::orderBy('id', 'DESC')->paginate(10);
            return view('sportCategory.index', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Add
     */
    public function add(Request $request)
    {
       try {
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            } 
            $data = SportCategory::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => isset($filename) ? $filename : '',
                'status' => '1',
            ]);
            return redirect('sport-category-index');
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
            $data = SportCategory::find($id);
            
            return view('sportCategory.edit', ['id' => $id, 'data' => $data]);
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
            if ($request->hasFile('image')) {
                $file = $request->file('image')->getClientOriginalName();
                $filename = time() . $file;
                $path = public_path('/Uploads');
                $file = $request->file('image');
                $file->move($path, $filename);
            } 
            $data =  SportCategory::where('id', $id)->update(['title' => $request->title,
             'description' => $request->description,
             'image' => isset($filename) ? $filename : ''
            ]);
            return redirect('sport-category-index');
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
            $name="fc-category-".date('Ymd').".csv";
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=".$name);
            header("Pragma: no-cache");
            header("Expires: 0");

            $categories = SportCategory::orderBy('id', 'DESC')->get();
            $columns = array('Sr.', 'Title', 'Description');

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($categories as $key=>$category) {
                fputcsv($file, array($key+1, $category->title, $category->description));
            }
            exit();
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
            $SportCategory =  SportCategory::where('id', $id)
            ->update(['status' => 0]);

            return redirect('sport-category-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
     /**
     * Not Delete
     */
    public function notdelete()
    {
        try {
            $id = request()->get('id');
            $SportCategory =  SportCategory::where('id', $id)
            ->update(['status' => 1]);

            return redirect('sport-category-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    /**
     * category list
     */

    public function category_list()
    { 
        try { 
            $data = DB::table('teams')->paginate(15);
            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ], 400);
        }
    }
    // view page detail
    public function view()
    {
        try {
            $id = request()->get('id');
            $data = SportCategory::find($id);
            return view('sportCategory.view', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    // Import
    public function input()
    {
        try {
            return view('sportCategory.import');
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
            $file = "http://15.188.226.196/public/"."/Uploads/".$filename;
            
            $handle = fopen($file, "rb");
            while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $title = isset($getData[0])?$getData[0]:'';
                $description =isset($getData[1])?$getData[1]:'';

                $data = SportCategory::create([
                    'title' => $title,
                    'description' => $description
                ]);
            }
            return redirect('sport-category-index');
        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}
