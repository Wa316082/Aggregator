<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Coupon;


class CouponHistory extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function orderId(){
        return $this->belongsTo(Order::class, 'order_id','custom_order_id');
    }

    public function couponId(){
        return $this->belongsTo(Coupon::class, 'coupon_id','id');
    }
}
