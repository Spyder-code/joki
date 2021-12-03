<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\TransactionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validated = $this->validate($request, [
                'category_id' => 'required',
                'title' => 'required',
                'note' => 'required',
                'deadline' => 'required|date',
            ]);
            $validated['transaction_status_id'] = 1;
            $validated['customer_id'] = Auth::id();
            $validated['code'] = 'TR'.$this->generateRandomString();
            $transaction = Transaction::create($validated);
            Notification::create([
                'transaction_id' =>$transaction->id,
                'notification_type_id'=>1
            ]);

            if ($request->file()) {
                $directory_user = 'public/user/'.Auth::id().'_'.Auth::user()->username.'/'.$transaction->id;
                foreach ($request->file('file') as $index => $item) {
                    $file_name = $request->file[$index]->getClientOriginalName();
                    $path = $request->file[$index]->storeAs($directory_user,$file_name);
                    $url = Storage::url($path);
                    $file_url = url($url);
                    TransactionFile::create([
                        'transaction_id' => $transaction->id,
                        'name' => $file_name,
                        'url' => $file_url,
                    ]);
                }
            }
            return redirect(route('transaction.show',$transaction))->with('pesanan','pesanan berhasil dibuat');
        }else{
            return redirect()->back()
                ->with('error','Anda harus login terlebih dahulu')->withInput($request->all());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if ($transaction->customer_id==Auth::id()||Auth::id()==1) {
            $file = TransactionFile::all()->where('transaction_id',$transaction->id);
            $review = Review::all()->where('transaction_id',$transaction->id)->first();
            return view('user.transaction_detail',compact('transaction','file','review'));
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function addFile(Transaction $transaction, Request $request)
    {
        if ($request->file()) {
            $directory_user = 'public/user/'.Auth::id().'_'.Auth::user()->username.'/'.$transaction->id;
            foreach ($request->file('file') as $index => $item) {
                $file_name = $request->file[$index]->getClientOriginalName();
                $path = $request->file[$index]->storeAs($directory_user,$file_name);
                $url = Storage::url($path);
                $file_url = url($url);
                TransactionFile::create([
                    'transaction_id' => $transaction->id,
                    'name' => $file_name,
                    'url' => $file_url,
                ]);
            }
            return redirect(route('transaction.show',$transaction))->with('pesanan','File berhasil diupload');
        }else{
            return back()->with('error','File tidak dapat diunggah');
        }
    }

    public function review(Request $request)
    {
        Review::create($request->all());
        return back()->with('review','Review berhasil ditambahkan');
    }

    public function generateRandomString($length = 4) {
        $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
