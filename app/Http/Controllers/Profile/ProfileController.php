<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $title = 'All user';
        $user = User::where('role', 'user')->get();
        return view('home.user.index', compact('title', 'user'));
    }
    public function resetPassword($id) {
        // get data by id
        $user = User::find($id);
        $user->password = Hash::make('123456');
        $user->save();
        return redirect()->back()->with('success', 'Password has been reset!');
    }

    public function createProfile() {
        $title = 'Create Profile';
        return view('home.Profile.create', compact('title'));
    }
    public function storeProfile(Request $request) {
        // validate
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        // store image
        $image = $request->file('image');
        $image->storeAs('public/profile', $image->getClientOriginalName());

        // get user login
        $user = auth()->user();

        // craete data profile
        $user->profile()->create([
            'first_name' => $request->first_name,
            'image' => $image->getClientOriginalName()
        ]);
        return redirect()->route('profile.index')->with('success', 'Profile has been created');
    }
    public function editProfile() {
        // get data user login
        $title = 'Edit Profile';
        $user = auth()->user();
        return view('home.Profile.edit', compact('title', 'user'));
    }
    public function updateProfile(Request $request) {
        // validate
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,png'
        ]);

        // get user login
        $user = auth()->user();

        // cek kondisi image apabila tidak diupdate
        if($request->file('image') == '') {
            $user->profile->update([
                'first_name' => $request->first_name
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile berhasil diupdate');
        } else {
            // delete image
            Storage::delete('public/profile' . basename('$user->profile->image'));

            // store image
            $image = $request->file('image');
            $image->storeAs('public/profile', $image->getClientOriginalName());

            // update data
            $user->profile->update([
                'first_name' => $request->first_name,
                'image' => $image->getClientOriginalName()
            ]);

            return redirect()->route('profile.index')->with('success', 'Profile berhasil diupdate');
        }
    }
}
