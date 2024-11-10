<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        
        // Store OTP in cache for 5 minutes
        Cache::put('otp_'.$request->mobile, $otp, now()->addMinutes(5));

        // Send OTP via SMS (using Twilio for example)
        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $message = $twilio->messages->create(
                "+91 ".$request->mobile,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => "Your OTP is: $otp"
                ]
            );
            return response()->json(['message' => 'OTP sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Twilio error: '.$e->getMessage());
            return response()->json(['message' => 'Failed to send OTP'], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:6'
        ]);

        $otp = Cache::get('otp_'.$request->mobile);

        if ($otp && $otp == $request->otp) {
            // Optionally create a new user or authenticate
            $user = User::firstOrCreate(['name' => $request->mobile,'email' => $request->mobile.'@test.com','password' => $request->mobile,'mobile' => $request->mobile]);

            return response()->json(['message' => 'OTP verified', 'user' => $user], 200);
        }

        return response()->json(['message' => 'Invalid OTP'], 400);
    }
}
