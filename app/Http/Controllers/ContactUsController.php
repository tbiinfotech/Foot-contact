<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\ContactReason;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // index page
    public function index()
    {
        try {
        $data = ContactUs::get();
        return view('contactUs.index', ['data' => $data]);
    } catch (\Exception $e) {
        return $this->error($e->getMessage());
    }
        
    }
    // create page
    public function create()
    {try {
        $reason = ContactReason::get();
        return view('contactUs.add', ['reason' => $reason]);
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
            $data = ContactUs::create([
                'contact_reason_id' => $request->contact_reason_id,
                'message' => $request->message,
                'status' => '1'
            ]);
            return redirect('contact-us-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * edit
     */
    public function edit()
    {try {
        $id = request()->get('id');
        return view('contactUs.edit', ['id' => $id]);
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
            $data =  ContactUs::where('id', $id)->update(['title' => $request->title]);
            return redirect('contact-us-index');
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
            $data = ContactUs::find($id)->delete();
            return redirect('contact-us-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
