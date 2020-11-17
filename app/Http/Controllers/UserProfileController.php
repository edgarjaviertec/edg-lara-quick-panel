<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Traits\SessionsTrait;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    use SessionsTrait;

    public function show(Request $request)
    {
        return view('pages.admin.profile')->with('sessions', $this->sessions($request)->all());
    }
}