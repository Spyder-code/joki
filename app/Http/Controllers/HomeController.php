<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $visitor = Visitor::all();
        // $user = User::all();
        // return view('admin.main',compact('visitor','user'));
        if (Auth::user()->role_id==3) {
            return redirect()->route('user.beranda')->with('login','login berhasil');
        } else {
            // return redirect()->route('home');
            return view('layouts.dashboard');
        }
    }

    public function profile()
    {
        return view('profile');
    }

    public function freelance()
    {
        $data = User::all()->where('role_id',2);
        return view('admin.freelance', compact('data'));
    }

}
