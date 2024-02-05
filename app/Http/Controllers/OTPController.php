<?php

namespace App\Http\Controllers;
use App\Notifications\SendOTP;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function generateAndSendOTP(Request $request)
    {
        $otp = mt_rand(1000, 9999);

        $request->user()->notify(new SendOTP($otp));

        return response()->json(['message' => 'OTP sent successfully']);
    }
    public function verifyOTP(Request $request)
    {
        $submittedOTP = $request->input('otp');

        $storedOTP = $request->session()->get('otp');

        if ($submittedOTP == $storedOTP) {
            return response()->json(['message' => 'OTP verified successfully']);
        } else {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }
    public function showLoginForm()
    {
        $otp = $this->generateAndSendOTP();

        Session::put('otp', $otp);

        return view('otp-login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|exists:users,phone_number',
            'otp' => 'required|string|digits:6',
        ]);
        $user = User::where('phone_number', $request->phone_number)->first();

        if (! $user || ! Hash::check($request->otp, $user->otp)) {
            return response()->json(['errors' => ['invalid_credentials' => 'Invalid OTP or phone number']], 401);
        }

        $submittedOTP = $request->input('otp');

        $storedOTP = Session::get('otp');

        if ($submittedOTP == $storedOTP) {

            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } else {
            return back()->withInput()->withErrors(['otp' => 'Invalid OTP']);
        }
    }


}
