<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.request-reset-code');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $code = strtoupper(Str::random(6)); // Generate 6 character code
        
        // Store code per email to prevent conflicts
        $resetData = session('reset_data', []);
        $resetData[$request->email] = [
            'code' => $code,
            'created_at' => now()->timestamp
        ];
        session(['reset_data' => $resetData]);

        return redirect()->route('password.show-reset-form')->with([
            'code' => $code,
            'email' => $request->email
        ]);
    }

    public function showResetForm()
    {
        $email = session('email');
        $resetData = session('reset_data', []);
        
        if (!$email || !isset($resetData[$email])) {
            return redirect()->route('password.request-code')->withErrors(['general' => 'Session expired. Please request a new code.']);
        }

        return view('auth.reset-with-code');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetData = session('reset_data', []);
        
        if (!isset($resetData[$request->email])) {
            return back()->withErrors(['code' => 'Kode reset tidak valid atau sudah expired.']);
        }

        $storedData = $resetData[$request->email];
        
        // Check if code matches and not expired (30 minutes)
        if ($request->code !== $storedData['code'] || 
            (now()->timestamp - $storedData['created_at']) > 1800) {
            return back()->withErrors(['code' => 'Kode reset tidak valid atau sudah expired.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the reset data for this email
        unset($resetData[$request->email]);
        session(['reset_data' => $resetData]);

        return redirect()->route('login')->with('status', 'Password berhasil direset!');
    }
}
