<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('forget');
    }

    public function submitForgetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
//        dd($request->all());
        $token = Str::random(64);


        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

//        $action_link = route('forgetPassword', ['token' => $token, 'email' => $request->email]);
//        $body = "We are received a request to reset the password for <b>Your app Name </b> account associated with ".$request->email.
//        ". You can reset your password by clicking the link bellow";
//
//        Mail::send('reset.password',['action_link' => $action_link, 'body' => $body], function($message) use ($request){
//            $message->form('hhakobyan404@gmail.com', 'Your App Name');
//            $message->to($request->email, 'Your name')
//                    ->subject('Reset Password');
//        });
        $link = Mail::send('emails.resetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        if ($link){
            return back()->with('message', 'We have e-mailed your password reset link!. Please Check your email');
        }else{
            dd('errorrrr');
        }
    }

    public function change($token)
    {
        return view('emails.changePassword',['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }

}
