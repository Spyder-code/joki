<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Visitor;
use App\Repositories\TransactionService;
use App\Repositories\UserService;
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

    private $transactionService;
    private $userService;
    public function __construct(TransactionService $transactionService, UserService $userService)
    {
        $this->transactionService = $transactionService;
        $this->userService = $userService;
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
            $count = $this->transactionService->count();
            if (Auth::user()->role_id==1) {
                $user = $this->userService->freelance();
                $data = $this->transactionService->allWithStatus(1);
                $rating = null;
            }else{
                $data = $this->transactionService->allWithStatus(2);
                $star = $this->transactionService->rating()->sum('star');
                $sum = $this->transactionService->rating()->count();
                $rating = $star/$sum;
                $user = null;
            }
            return view('main', compact('data','count','user','rating'));
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
