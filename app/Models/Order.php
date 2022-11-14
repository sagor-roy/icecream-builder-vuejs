<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'phone',
        'address',
        'order_status',
        'trans_id',
        'payment_methods',
    ];

    public function item()
    {
        return $this->hasMany(Item::class, 'order_id', 'id');
    }
}
