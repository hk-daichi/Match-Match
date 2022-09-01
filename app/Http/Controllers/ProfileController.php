<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return view('profiles/index')->with(['profiles' => $profile->getPaginateByLimit()]);
    }
}