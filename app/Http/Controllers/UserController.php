<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class UserController extends Controller
{

    /**
     * Display Home page.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user() == null) {
            return view("auth.login");
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Display Home page.
     *
     * @return Response
     */
    public function verify()
    {
        if (Auth::user() == null) {
            return redirect('/login');
        } else {
            $user_id = Auth::user()->id;
            $user_detail = User::where(['id' => $user_id])->first();
            $email = $user_detail->email;
            // $otp = ($email == 'admin@gmail.com' || $email == 'club@gmail.com' || $email == 'contact@footcontact.fr' || $email == 'jacques.canonge@gmail.com') ? '1234' : rand(1111, 9999);
            $otp = ($email == 'admin@gmail.com' || $email == 'club@gmail.com' || $email == 'contact@footcontact.fr' || $email == 'jacques.canonge@gmail.com') ? '1234' :  '1234';

            // if ($otp === '1234') {
            User::where(['id' => $user_id])->update([
                'token' => $otp,

                'verified' => '0',
                'token_expires_at' => date("Y-m-d H:i:s", strtotime("+10 minutes"))
            ]);
            return view('auth.authentication');
            //    }
            // $phone = $user_detail->phone;
            // if (!empty($phone)) {
            //     try {
            //         User::where(['id' => $user_id])->update([
            //             'token' => $otp,
            //             'verified' => '0',
            //             'token_expires_at' => date("Y-m-d H:i:s", strtotime("+10 minutes"))

            //         ]);
            //         $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
            //         $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
            //         $twilio_number = "+19253971037";
            //         $client = new Client($account_sid, $auth_token);
            //         $message =   $client->messages->create(
            //             // Where to send a text message (your cell phone?)
            //             '+33' . $phone,
            //             array(
            //                 'from' => $twilio_number,
            //                 'body' => 'OTP is' . $otp
            //             )
            //         );
            //         return view('auth.authentication');
            //     } catch (\Twilio\Exceptions\RestException $e) {
            //         echo "Error sending SMS: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
            //         return back()->with('error', 'Phone number is Invalid!');
            //     }
            // } else {
            //     return back()->with('error', 'Please add phone number!');
            // }
        }
    }

    /**
     * Function for Login.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');

        if (Auth::attempt(['email' => $email, 'password'  => $password])) {
            $user_id = Auth::user()->id;
            $user_detail = User::where(['id' => $user_id])->first();
            $otp = '1234'; //rand(1111, 9999);
            $phone = $user_detail->phone;
            // if (!empty($phone)) {
            try {
                $account_sid = 'ACdff222cf9b10fd6f79a03df17f94a7c6';
                $auth_token = 'd8ccb066d462fae645a3beffdf93d9c0';
                $twilio_number = "+19253971037";
                $client = new Client($account_sid, $auth_token);
                $message =   $client->messages->create(
                    // Where to send a text message (your cell phone?)
                    '+33' . $phone,
                    array(
                        'from' => $twilio_number,
                        'body' => 'OTP is' . $otp
                    )
                );
                return redirect('/verify');
            } catch (\Twilio\Exceptions\RestException $e) {
                echo "Error sending SMS: " . $e->getCode() . ' : ' . $e->getMessage() . "\n";
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the the Home page.
     *
     * @return Response
     */
    public function verification(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $user_detail = User::where(['id' => $user_id])->first();
            $current_time = date("Y-m-d H:i:s");
            if ($current_time < $user_detail->token_expires_at) {
                if ($request->code == $user_detail->token) {
                    User::where(['id' => $user_id])->update([
                        'verified' => '1',
                    ]);

                    return redirect('/dashboard');
                } else {
                    return back()->with('error', 'OTP is not correct!');
                }
            } else {
                return back()->with('error', 'OTP time expire!');
            }
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }
    /**
     * Display the the reset page.
     *
     * @return Response
     */
    public function reset($token)
    {
        try {

            return view('auth.password', ['token' => $token]);
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }
    /**
     * Display the the reset password email page.
     *
     * @return Response
     */
    public function resetEmail()
    {
        return view('auth.passwords.email');
    }
    public function sendLink(Request $request)
    {
        try {
            $email = $request->email;
           
            $user=  User::where(['email'=>$email])->first();
            if(!empty($user)){
            //send mail 
            $details = [ 
                'reset_token' => $user->reset_token,
                'email' => $user->email,
                
                'title' => 'Mail from Online Web Tutor',
                'body' => 'Test mail sent by Laravel 8 using SMTP.'
            ];
            Mail::to($user->email)->send(new \App\Mail\ResetMail($details));
            session()->flash('success', "Please Check your Email");
           }else{
            session()->flash('error', "Email is not Registered");
           }
           
           return Redirect::back();
            // return redirect('/login');
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }

    public function updatePassword(Request $request) 
    { 
        try {
            $password = Hash::make($request->password);
            // $validator = FacadesValidator::make($request->all(), [
            //     'password'  =>  'required|min:8|confirmed',
            // ]);
            // if ($validator->fails()) {
            //     return back()->withErrors($validator->errors())->withInput();
            // }
            $data = User::where(['reset_token' => $request->token])
                ->update(['password' => $password]);
            return redirect('/login');
        } catch (\Exception $e) {
            echo $this->error($e->getMessage());
            return redirect('/login');
        }
    }

    /**
     * Display the the Home page.
     *
     * @return Response
     */
    // public function home(Request $request){

    //     if (Auth::user() != null){

    //         //Getting User information.
    //         $users = User::where('id', Auth::user()->id)->first();
    //         $users['mobile'] = substr($users['mobile'], -4);

    //         return view("myHome",compact('users'));
    //     }else{
    //         return redirect('/');
    //     }
    // }

    /**
     * Function to log out User
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
