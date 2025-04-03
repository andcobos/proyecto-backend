<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerStatus extends Model
{
    use HasFactory;

    protected $table = 'seller_status';

    protected $fillable = [
        'status',
    ];
}
