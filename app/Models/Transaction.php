<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'customer_id',
        'transaction_status_id',
        'code',
        'title',
        'note',
        'price',
        'deadline',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,  'customer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function freelance()
    {
        return $this->hasOne(TransactionUser::class,'transaction_id');
    }

    public function freelance_transaction_with_status($status_id)
    {
        return $this->join('transaction_users','transactions.id','=','transaction_users.transaction_id')
                ->where('transactions.transaction_status_id',$status_id)
                ->where('transaction_users.freelance_id',Auth::id())
                ->select('transactions.*')
                ->get();
    }

    public function freelance_transaction_all()
    {
        return $this->join('transaction_users','transactions.id','=','transaction_users.transaction_id')
                ->where('transaction_users.freelance_id',Auth::id())
                ->select('transactions.*')
                ->get();
    }

    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function notif()
    {
        return $this->belongsTo(NotificationType::class,'transaction_status_id');
    }

}
