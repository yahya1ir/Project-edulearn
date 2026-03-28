<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //  login  view
    public function dash() {
    $courses = Course::all();
    return view('Dashboardstudent', compact('courses'));
}


    //  login  view
    public function login(){
        return view('login');
    }


    
    //  register  view
    public function register(){
        return view('register');
    }


   // loginpost
   public function loginPost(Request $req)
    {

        $req->validate([
            'email' => 'required|email',
            'password' => 'required',      
        ]);

        $user = User::where('email', $req->email)->first();

        if ($user && Hash::check($req->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }




    // registerpostt
     public function registerPost(Request $req)
    {
        // Validate the input
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        
        Auth::login($user);
   
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    //logout
    public function logout()
    {
        Auth::logout();


        return redirect()->route('login'); 
    } 


}
