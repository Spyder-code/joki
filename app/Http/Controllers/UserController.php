<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'username' => 'required',
            'email' => 'required|email'
        ]);

        if (!empty($request->avatar)) {
            $request->validate([
                'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);
            $profileImage = Auth::id().'.jpg';
            $path = $request->file('avatar')->storeAs('public/user/avatar', $profileImage);
            $url = Storage::url($path);
            $imgUrl = url('/').$url;
            $validate['avatar'] = $imgUrl;
        }
        User::find(Auth::id())->update($validate);
        return back()->with('success', 'Profil berhasil diupdate');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(Auth::id())->update(['password'=>Hash::make($request->password)]);
            return back()->with('success','Password berhasil diubah');
        }else{
            return back()->with('error','Password lama salah');;
        }
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($files = $request->file('avatar')) {
            $profileImage = Auth::id().'.jpg';
            $path = $files->storeAs('public/user', $profileImage);
            $url = Storage::url($path);
            $imgUrl = url($url);
            User::find($id)->update(['avatar'=>$imgUrl]);
            return back()->with('success','Avatar berhasil diubah');
        }
    }

}
