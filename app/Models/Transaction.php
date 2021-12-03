<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
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
