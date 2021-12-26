<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\TransactionFile;
use App\Models\TransactionUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransactionService extends Repository
{
    public $requestService;

    public function __construct()
    {
        $this->requestService = new Transaction;
        $this->model = new Transaction;
    }

    public function all()
    {
        if (Auth::user()->role_id==1) {
            $data = $this->requestService->all();
        } else {
            $data = $this->requestService->freelance_transaction_all();
        }

        return $data;
    }

    public function allWithStatus($status_id)
    {
        if ($status_id==5) {
            return $this->requestService->all()->where('transaction_status_id',$status_id);
        }else{
            if (Auth::user()->role_id==1) {
                if ($status_id!=0) {
                    return $this->requestService->all()->where('transaction_status_id',$status_id);
                }else{
                    $this->all();
                }
            }else{
                return $this->requestService->freelance_transaction_with_status($status_id);
            }
        }
    }

    public function count()
    {
        if (Auth::user()->role_id==1) {
            $pending = $this->requestService->all()->where('transaction_status_id',1)->count();
            $progress = $this->requestService->all()->where('transaction_status_id',2)->count();
            $finish = $this->requestService->all()->where('transaction_status_id',3)->count();
            $ready = $this->requestService->all()->where('transaction_status_id',5)->count();
        }else{
            $pending = $this->requestService->freelance_transaction_with_status(1)->count();
            $progress = $this->requestService->freelance_transaction_with_status(2)->count();
            $finish = $this->requestService->freelance_transaction_with_status(3)->count();
            $ready = $this->requestService->freelance_transaction_with_status(5)->count();
        }

        $data['pending'] = $pending;
        $data['progress'] = $progress;
        $data['finish'] = $finish;
        $data['ready'] = $ready;

        return $data;
    }

    public function confirmation($data, $id)
    {
        if (!empty($data['freelance_id'])) {
            $transaction = $this->requestService->find($id)->update([
                'price' => $data['price'],
                'transaction_status_id' => 2,
            ]);
            TransactionUser::create([
                'transaction_id' => $id,
                'freelance_id' => $data['freelance_id'],
                'status' => 0,
            ]);
            Notification::create([
                'transaction_id' =>$id,
                'notification_type_id'=>2
            ]);
        }else{
            $transaction = $this->requestService->find($id)->update([
                'price' => $data['price'],
                'transaction_status_id' => 5,
            ]);
            Notification::create([
                'transaction_id' =>$id,
                'notification_type_id'=>5
            ]);
        }
        return $transaction;
    }

    public function updateStatus($status,$id)
    {
        if ($status==3) {
            TransactionUser::where('transaction_id',$id)->update([
                'status' => 1,
            ]);
        }
        Notification::create([
            'transaction_id' =>$id,
            'notification_type_id'=>$status
        ]);
        return $this->requestService->find($id)->update(['transaction_status_id'=>$status]);
    }

    public function freelanceTake($id)
    {
        TransactionUser::create([
            'transaction_id' => $id,
            'freelance_id' => Auth::id(),
            'status' => 0,
        ]);

        $this->updateStatus(2,$id);
    }

    public function insertFile($transaction_id, $data,$type)
    {
        // dd($data['file_progress']);
        $directory_user = 'public/user/'.Auth::id().'_'.Auth::user()->username.'/'.$transaction_id;
        foreach ($data as $index => $item) {
            $file_name = $item->getClientOriginalName();
            $path = $item->storeAs($directory_user,$file_name);
            $url = Storage::url($path);
            $file_url = url($url);
            TransactionFile::create([
                'transaction_id' => $transaction_id,
                'name' => $file_name,
                'url' => $file_url,
                'file_type_id'=> $type
            ]);
        }
        return true;
    }
    public function updateData($data)
    {
        return $this->requestService->update($data);
    }

    public function getFileType($id,$type)
    {
        return TransactionFile::all()->where('transaction_id',$id)->where('file_type_id',$type);
    }

    public function deleteFile($id)
    {
        return TransactionFile::destroy($id);
    }

    public function rating()
    {
        $data = $this->requestService->freelance_transaction_all();
        $id = array();
        foreach ($data as $item ) {
            array_push($id,$item->id);
        }
        return Review::all()->whereIn('transaction_id',$id);
    }
}
