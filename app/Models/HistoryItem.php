<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryItem extends Model
{
    protected $fillable = ['history_id', 'product_id', 'quantity', 'price'];

    public function history()
    {
        return $this->belongsTo(History::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
