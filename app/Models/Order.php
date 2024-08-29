<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $timestamps = true;
    protected $table = 'orders';
    protected $primaryKey = 'id';


    protected $fillable = ['id', 'user_id', 'total_amount', 'order_id', 'payment_status'];

}

