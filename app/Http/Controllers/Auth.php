<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Password;

class Auth extends Controller
{
    public function getCreate() {
      return view('auth/create');
    }

    public function postCreate(Request $req) {
      $req->validate([
        'name' => 'required|min:3',
        'email' => 'required|min:3|unique:App\Models\User,email',
        'password' => 'required|min:6'
      ]);

      User::create([
        'name' => $req->name,
        'email' => $req->email,
        'password' => Hash::make($req->password)
      ]);

      $data = ['message' => 'Thank you for singing up, '.$req->name];
      Mail::to($req->email)->send(new TestEmail($data));

      if (Mail::failures()) {
        return response()->Fail('Sorry! Please try again latter');
      }
      if(!auth()->attempt($req->only('email', 'password'))) {
        return redirect()->back();
      } else {
        return redirect('/posts');
      }
    }

    public function getLogin() {      
        return view('auth/login');
      } 
    

    public function postLogin(Request $req) {
      
        $req->validate([
          'email' => 'required',
          'password' => 'required'
        ]);


        if(!auth()->attempt($req->only('email', 'password'))) {
          return redirect('/login');
        } else {
          return redirect('/posts');
        }        
    }

    public function logout(Request $req) {
      auth()->logout();
      return redirect('/posts');
    }

    public function getForgotPassword() {
      return view('auth.forgotpassword');
    }

    public function postForgotPassword(Request $req) {
      $req->validate([
        'email' => 'required|email'
        ]);
        
      $status = Password::sendResetLink($req->only('email'));
      
      return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Password link has been sent.')
        : back()->with('error', 'Oops something went wrong. Please try again.');
    }

    public function getForgotPasswordWToken($token) {
      return view('auth.forgotpasswordwtoken', [
        'token' => $token,
      ]);
    }

    public function postForgotPasswordWToken(Request $req) {
      $req->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6'
      ]);

      $status = Password::reset($req->only('email', 'password', 'password_confirmation', 'token'),
        function($user, $password) use ($req) {
          $user->forceFill([
            'password' => Hash::make($password)
          ]);

          $user->save();
      });

      return $status == Password::PASSWORD_RESET 
        ? redirect()->route('login')->with('success', 'Password has been successfully updated.')
        : back()->with('error', 'Oops something went wrong. Please try again.'); 
    }
}
