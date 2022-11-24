<?php

namespace App\Http\Controllers;

use App\Models\ContactReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;

class ContactReasonController extends Controller
{
    // index page
    public function index()
    {
        try {
            $data = ContactReason::orderBy('id', 'DESC')->get();
            return view('contactReason.index', ['data' => $data]);
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
            $data = ContactReason::create([
                'title' => $request->title,
                'status' => '1',
            ]);
            if ($data->save()) {
                return redirect('contact-reason-index');
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
        return view('contactReason.add');
    }
    /**
     * edit
     */
    public function edit()
    {
        try {
            $id = request()->get('id');
            return view('contactReason.edit', ['id' => $id]);
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
            $data =  ContactReason::where('id', $id)->update(['title' => $request->title]);
            return redirect('contact-reason-index');
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
            $data = ContactReason::find($id)->delete();
            return redirect('contact-reason-index');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
   
    /**
     * send email
     */
    public function send_mail(Request $request)
    {
        // try {
            // $mailData = [
            //     'title' => 'Mail from Mansjoer.com',
            //     'body' => 'This is for testing email using smtp.'
            // ];
            
            // $reason = $request->reason;
            // $description = $request->description;
            // $email = Auth::user()->email;
            $details = [
                'title' => 'Mail from Online Web Tutor',
                'body' => 'Test mail sent by Laravel 8 using SMTP.'
            ];
            Mail::to('shavi.rishi@brihaspatitech.com')->send(new \App\Mail\DemoMail($details));
            return redirect('contact-reason-index');
        // } catch (\Exception $e) {
        //     return $this->error($e->getMessage());
        // }
        return view('contactReason.add'); 
    }
}
