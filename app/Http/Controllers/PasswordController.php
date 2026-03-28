<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    // Show forgot form
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $link = url('/reset-password/' . $token);

        // Simple email (for now)
        Mail::raw("Click here to reset password: $link", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset');
        });

        return back()->with('success', 'Reset link sent!');
    }

    // Show reset form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'token' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid token');
        }

        // Update password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Delete token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect('/login')->with('success', 'Password reset successful!');
    }
}