<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Status;

class Statushistory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function order(){
        return $this->belongsTo(Order::class, 'custom_order_id','custom_order_id');
    }
    public function substatus(){
        return $this->belongsTo(Status::class, 'status_id','id');
    }
}
