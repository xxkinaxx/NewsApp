<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request){
        try {
            // validate
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // cek credentials (login)
            $credentials = request(['email', 'password']);
            if (!Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ])) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            };
            // cek password
            $user = User::where('email', $credentials['email'])->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }
            // jika berhasil cek password maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request) {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255', 
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);
            // cek password & confirm_password
            if($request->password != $request->confirm_password) {
                return ResponseFormatter::error([
                    'message' => 'Password not match'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
        // create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // get data akun
        $user = User::where('email', $request->email)->first();

        // create token
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        // response
        return ResponseFormatter::success([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ], 'Authenticated', 200);
    }

    public function logout(Request $request) {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function allUsers() {
        $users = User::where('role', 'user')->get();
        return ResponseFormatter::success(
            $users, 'Data user berhasil diambil'
        );
    }

    public function updatePassword(Request $request){
        try {
            // validate
            $this->validate($request,[
                'old_password' => 'required',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6'
            ]);
    
            // get data user
            $user = Auth::user();
    
            // check old password
            if(!Hash::check($request->old_password, $user->password)){
                return ResponseFormatter::error([
                    'message' => 'Password Lama Tidak Sama'
                ], 'Authentication Failed', 401);
            }
    
            // check new password and confirm password
            if($request->new_password != $request->confirm_password){
                return ResponseFormatter::error([
                    'message' => 'Password Tidak Sesuai'
                ], 'Authentication Failed', 401);
            }
    
            // update password
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return ResponseFormatter::success([
                'message' => 'Password Berhasil Diubah'
            ], 'Authenticated', 200);
    
        } catch (\Throwable $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function storeProfile(Request $request) {
        try {
            // validate
            $this->validate($request, [
                'name' => 'required',
                'first_name' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg'
            ]);

            // get date user
            $user = auth()->user();

            // upload image
            $image = $request->file('image');
            $image->storeAs('public/profile', $image->hashName());

            // create profile
            $user->profile()->create([
                'name' => $request->name,
                'first_name' => $request->first_name,
                'image' => $image->hashName()
            ]);

            // get data profile
            $profile = $user->profile;

            return ResponseFormatter::success(
                $profile, 'Profile successfully created'
            );
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function updateProfile(Request $request) {
        try {
            // validate
            $this->validate($request, [
                'name' => 'required',
                'first_name' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg'
            ]);

            // get data user
            $user = auth()->user();

            // dek jika user belum punya profile
            if (!$user->profile) {
                return ResponseFormatter::error([
                    'message' => 'Profile not Found, Please create a profile first'
                ], 'Authentication Failed', 404);
            }

            if ($request->file('image') == '') {
                $user->profile->update([
                    'name' => $request->name,
                    'first_name' => $request->first_name
                ]);
            } else {
                // delete old image
                Storage::disk('local')->delete('/public/profile/' . basename($user->image));
                // upload new image
                $image = $request->file('image');
                $image->storeAs('public/profile', $image->hashName());

                // update data user
                $user->profile->update([
                    'name' => $request->name,
                    'first_name' => $request->first_name,
                    'image' => $image->hashName()
                ]);
            }

            return ResponseFormatter::success([
                'profile' => $user->profile
            ], 'Profile Updated');
            
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
