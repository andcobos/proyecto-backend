<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $fillable = [
        'user_id',
        'seller_status_id',
        'verified',
    ];

    // Relación User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación SellerStatus
    public function sellerStatus()
    {
        return $this->belongsTo(SellerStatus::class, 'seller_status_id');
    }
}
