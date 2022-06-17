<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Image;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {

        return view('backend.profile.index', [
            'user' => $request->user(),
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->update([
            'name' => $request->name
        ]);

        return back()->with("status", "Profil został zaktualizowane!");
    }

    public function changePassword()
    {
        return view('backend.profile.index');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Stare hasło nie pasuje!");
        }


        #Update the new Password
        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Hasło zostało zaktualizowane!");
    }

    public function update_avatar(Request $request)
    {

        $user = Auth::user();
        $oldAvatar = $user->avatar;

        if ($request->hasFile('avatar')) {

//            dd(File::exists(public_path('uploads/avatars/' . $oldAvatar)));

//            dd(Storage::disk('avatar')->exists($oldAvatar));

            if (File::exists(public_path('uploads/avatars/' . $oldAvatar)) && ($oldAvatar != 'default.jpg') ) {
                File::delete(public_path('uploads/avatars/' . $oldAvatar ));
            }

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(150, 150)->save( public_path('uploads/avatars/' . $filename ) );

            $user->avatar = $filename;
            $user->save();
        }

        return back()->with("status", "Avatar został zaktualizowany!");
    }

}
