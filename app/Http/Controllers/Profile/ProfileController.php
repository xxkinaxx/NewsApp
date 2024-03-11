<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $title = 'Profile - Index';
        return view('home.Profile.index', compact('title'));
    }
}
