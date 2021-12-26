<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\TransactionUser;
use App\Models\User;
use App\Repositories\CategoryService;
use App\Repositories\ServiceRepository;
use App\Repositories\TransactionService;
use App\Repositories\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $transactionService;
    private $categoryService;
    private $userService;

    public function __construct(TransactionService $transactionService, CategoryService $categoryService, UserService $userService)
    {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->transactionService->all();
        $user = $this->userService->freelance();
        return view('admin.transaction.index', compact('data','user'));
    }

    public function pending()
    {
        $user = $this->userService->freelance();
        $data = $this->transactionService->allWithStatus(1);
        return view('admin.transaction.index', compact('data','user'));
    }

    public function progress()
    {
        $data = $this->transactionService->allWithStatus(2);
        return view('admin.transaction.index', compact('data'));
    }

    public function finish()
    {
        $data = $this->transactionService->allWithStatus(3);
        return view('admin.transaction.index', compact('data'));
    }

    public function ready()
    {
        $data = $this->transactionService->allWithStatus(5);
        return view('admin.transaction.index', compact('data'));
    }

    public function confirmation(Request $request, Transaction $transaction)
    {
        $this->transactionService->confirmation($request->all(),$transaction->id);
        return back()->with('success','Konfirmasi Pesanan Sukses');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->categoryService->all();
        $user = $this->userService->all()->where('role_id',3);
        return view('admin.transaction.create', compact('category','user'));
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
            if (Auth::user()->role_id==1) {
                $validated['transaction_status_id'] = 5;
                $validated['price'] = $request->price;
            }else{
                $validated['transaction_status_id'] = 1;
            }
            if(!empty($request->customer_tipe)){
                if ($request->customer_tipe==0) {
                    $user = User::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'phone' => $request->phone,
                        'role_id' => 3,
                        'email' => $request->nama.'@gmail.com',
                        'avatar' => 'default.png',
                        'password' => Hash::make('user123'),
                    ]);
                    $validated['customer_id'] = $user->id;
                } else {
                    $validated['customer_id'] = $request->customer_id;
                }
            }else{
                $validated['customer_id'] = Auth::id();
            }
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
                        'file_type_id' => 1,
                    ]);
                }
            }
            if (Auth::user()->role_id==1) {
                return redirect(route('transaction.ready',$transaction))->with('pesanan','pesanan berhasil dibuat');
            }else{
                return redirect(route('transaction.show',$transaction))->with('pesanan','pesanan berhasil dibuat');
            }
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
            $file =  $this->transactionService->getFileType($transaction->id,1);
            $file_progress =  $this->transactionService->getFileType($transaction->id,2);
            $file_finish =  $this->transactionService->getFileType($transaction->id,3);
            $review = Review::all()->where('transaction_id',$transaction->id)->first();
            return view('user.transaction_detail',compact('transaction','file','file_progress','file_finish','review'));
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
        $category = $this->categoryService->all();
        $user = $this->userService->all();
        return view('admin.transaction.edit', compact('transaction','user','category'));
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
        if (!empty($request->file_progress)) {
            $this->transactionService->insertFile($transaction->id,$request->file_progress,2);
        }
        if (!empty($request->file_finish)) {
            $this->transactionService->insertFile($transaction->id,$request->file_finish,3);
            $this->transactionService->updateStatus(3,$transaction->id);
        }
        if (empty($request->file_finish) && empty($request->file_progress)) {
            $this->transactionService->update($request->all(),$transaction->id);
        }
        return back()->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->transactionService->destroy($transaction->id);
        return back()->with('success','Transaksi berhasil dihapus');
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

    public function getTransaction(Transaction $transaction)
    {
        $file = $this->transactionService->getFileType($transaction->id,1);
        $file_progress = $this->transactionService->getFileType($transaction->id,2);
        $file_finish = $this->transactionService->getFileType($transaction->id,3);
        return view('admin.transaction.job',compact('transaction','file','file_progress','file_finish'));
    }

    public function freelanceTake(Transaction $transaction)
    {
        $this->transactionService->freelanceTake($transaction->id);
        return redirect()->route('transaction.progress')->with('success','Pekerjaan berhasil diambil');
    }

    public function deleteFile(TransactionFile $transactionFile)
    {
        $this->transactionService->deleteFile($transactionFile->id);
        return back()->with('success','File berhasil terhapus');
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
