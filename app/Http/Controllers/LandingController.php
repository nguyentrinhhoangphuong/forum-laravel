<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LandingController extends Controller
{
    public function index()
    {
        $forums = Forum::orderBy("created_at", "DESC")->get();
        return view('landing.index', compact('forums'));
    }

    public function signin()
    {
        $title = "Sign In to Forum";
        return view('landing.signin', compact('title'));
    }

    public function signup()
    {
        $title = "Sign Up to Forum";
        return view('landing.signup', compact('title'));
    }

    public function signupcheck(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Hash the password before creating the user
            $validated['password'] = Hash::make($validated['password']);

            // Create the user
            $user = User::create($validated);

            // Redirect to user dashboard
            return response()->json([
                'success' => true,
                'message' => 'Signup successful!',
                'redirect' => route('user.dashboard', ['info' => $user->id])
            ]);
        } catch (ValidationException $e) {
            // Return validation errors as JSON
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Return generic error message
            return response()->json(['success' => false, 'message' => 'An error occurred.'], 500);
        }
    }


    public function signincheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'redirect' => route('user.dashboard', ['info' => Auth::user()->id])
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'email' => 'The provided credentials do not match our records.',
            ]
        ], 422);
    }

    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();
    
        // Xóa toàn bộ phiên làm việc
        $request->session()->invalidate();
    
        // Tạo một phiên mới để bảo mật
        $request->session()->regenerateToken();
    
        return redirect()->route('index');

    }
    
}
