<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'address', 'account', 'remark', 'trade_no', 'total', 'date', 'shipping_fee', 'status'];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function historyItems()
    {
        return $this->hasMany(HistoryItem::class);
    }
}
