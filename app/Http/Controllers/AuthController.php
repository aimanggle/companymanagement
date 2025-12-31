<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Find user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Store user info in session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);

            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to intended page or companies index
            return redirect()->intended(route('companies.index'))
                ->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        // Clear all session data
        Session::flush();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Get current authenticated user
     */
    public static function user()
    {
        if (session()->has('user_id')) {
            return User::find(session('user_id'));
        }
        return null;
    }
}