<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{

    public function show(Request $request)
    {
        $profile_photo_url = [
            'profile_photo_url' => $request->user()->profile_photo_url,
            'user_has_profile_photo' => $request->user()->profile_photo_path ? true : false
        ];
        return $profile_photo_url;
    }

    public function destroy(Request $request)
    {
        $request->user()->deleteProfilePhoto();
        return back(303)->with('status', 'profile-photo-deleted');
    }
}
