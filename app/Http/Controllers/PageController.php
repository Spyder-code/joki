<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\TransactionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all()->where('customer_id', Auth::id());
        $transaction_id = array();
        foreach ($transaction as $item ) {
            array_push($transaction_id,$item->id);
        }
        $notifikasi = Notification::all()->whereIn('transaction_id',$transaction_id);
        $count_read = Notification::all()->whereIn('transaction_id',$transaction_id)->where('is_read',0)->count();
        return view('user.index', compact('transaction','notifikasi','count_read'));
    }

    public function account()
    {
        return view('user.account');
    }

    public function categoryView()
    {
        return view('user.category_view');
    }

    public function createTransaction($category_id = 0)
    {
        $category = Category::all();
        return view('user.create_transaction', compact('category','category_id'));
    }

    public function sign_in()
    {
        return view('user.login');
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect()->route('user.beranda')->with('logout','logout berhasil');
    }
}
