<?php

namespace App\Http\Controllers;

use App\Models\presence;
use App\Models\User;
use Illuminate\Http\Request;

class AccController extends Controller
{ 
      public function absc(){

        $students = presence::all();

    
         return view('absence',compact('students'));
      }

      public function delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully!');
}


public function toggle($email)
{
    $presence = Presence::where('email', $email)->firstOrFail();

    $presence->statut = $presence->statut === 'present' ? 'absence' : 'present';

    $presence->save();
  return  redirect('absence');
   
} 
public function schedule(){
    return view('schedule');
}

}
