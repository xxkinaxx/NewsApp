<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $title = 'Profile - Index';
        return view('home.Profile.index', compact('title'));
    }
    public function changePassword(){
        $title = 'Change Your Password';
        return view('home.Profile.change-password', compact('title'));
    }
    public function updatePassword(Request $request){
        // validation
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        // check current password status
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus){
            if ($request->new_password == $request->confirm_password){
                // check user
                $user = auth()->user();
                // update password
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', 'your password already upated');
            } else {
                return redirect()->back()->with( 'error', 'Password does not match');
            }
        } else {
            return redirect()->back()->with( 'error', 'Current password is wrong');
        }
    }

    public function allUser() {
        
    }
}
