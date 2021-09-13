<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'status',
        'total',
    ];

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
