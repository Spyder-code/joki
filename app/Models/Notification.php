<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'notification_type_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function notification_type()
    {
        return $this->belongsTo(NotificationType::class);
    }
}
