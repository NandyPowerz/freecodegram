<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
   /**
    * Show the registration form.
    *
    * @return \Illuminate\View\View
    */
   public function showRegisterForm()
   {
       return view('auth.register');
   }

   /**
    * Handle the registration request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function register(Request $request)
   {
       // Validate form data
       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
       ]);

       if ($validator->fails()) {
           return back()
               ->withErrors($validator)
               ->withInput();
       }

       // Create user
       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ]);

       // Log the user in
       Auth::login($user);

       // Redirect to dashboard
       return redirect()->route('dashboard')->with('success', 'Welcome to Universal Church! Your account has been created successfully.');
   }

   /**
    * Show the login form.
    *
    * @return \Illuminate\View\View
    */
   public function showLoginForm()
   {
       return view('auth.login');
   }

   /**
    * Handle a login request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function login(Request $request)
   {
       $credentials = $request->validate([
           'email' => ['required', 'email'],
           'password' => ['required'],
       ]);

       if (Auth::attempt($credentials, $request->boolean('remember'))) {
           $request->session()->regenerate();

           return redirect()->route('dashboard')->with('success', 'Welcome back! You are now logged in.');
       }

       return back()->withErrors([
           'email' => 'The provided credentials do not match our records.',
       ])->onlyInput('email');
   }

   /**
    * Log the user out.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function logout(Request $request)
   {
       Auth::logout();

       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect('/')->with('success', 'You have been successfully logged out.');
   }

   /**
    * Show the dashboard page.
    *
    * @return \Illuminate\View\View
    */
   public function dashboard()
   {
       return view('dashboard');
   }

   /**
    * Show the forgot password form.
    *
    * @return \Illuminate\View\View
    */
   public function showForgotPasswordForm()
   {
       return view('auth.forgot-password');
   }

   /**
    * Send a password reset link.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function sendPasswordResetLink(Request $request)
   {
       $request->validate([
           'email' => 'required|email',
       ]);

       $status = Password::sendResetLink(
           $request->only('email')
       );

       return $status === Password::RESET_LINK_SENT
           ? back()->with(['status' => __($status)])
           : back()->withErrors(['email' => __($status)]);
   }

   /**
    * Show the reset password form.
    *
    * @param  string  $token
    * @return \Illuminate\View\View
    */
   public function showResetPasswordForm($token)
   {
       return view('auth.reset-password', ['token' => $token]);
   }

   /**
    * Reset the user's password.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function resetPassword(Request $request)
   {
       $request->validate([
           'token' => 'required',
           'email' => 'required|email',
           'password' => 'required|min:8|confirmed',
       ]);

       $status = Password::reset(
           $request->only('email', 'password', 'password_confirmation', 'token'),
           function ($user, $password) {
               $user->forceFill([
                   'password' => Hash::make($password)
               ])->setRememberToken(Str::random(60));

               $user->save();

               event(new PasswordReset($user));
           }
       );

       return $status === Password::PASSWORD_RESET
           ? redirect()->route('login')->with('status', __($status))
           : back()->withErrors(['email' => [__($status)]]);
   }

   /**
    * Show the user profile.
    *
    * @return \Illuminate\View\View
    */
   public function showProfile()
   {
       return view('auth.profile', [
           'user' => Auth::user()
       ]);
   }

   /**
    * Update the user profile.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function updateProfile(Request $request)
   {
       $user = Auth::user();

       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
           'current_password' => 'nullable|required_with:password|password',
           'password' => 'nullable|min:8|confirmed',
       ]);

       if ($validator->fails()) {
           return back()
               ->withErrors($validator)
               ->withInput();
       }

       $user->name = $request->name;
       $user->email = $request->email;

       if ($request->filled('password')) {
           $user->password = Hash::make($request->password);
       }

       $user->save();

       return back()->with('success', 'Profile updated successfully!');
   }
}