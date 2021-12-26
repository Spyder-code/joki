<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'freelance_id',
        'status'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'freelance_id');
    }

}
