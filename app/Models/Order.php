<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Location;
use App\Models\Pickup_Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'merchant_name',
        'customer_mobile',
        'customer_alt_mobile',
        'collection_amount',
        'delivery_address',
        'delivery_zone_id',
        'delivery_district_id',
        'return_charge',
        'return_chcoupon_idarge',
        'pickup_location_id',
        'latitude',
        'longitude',
        'user_id',
    ];


    // public function status()
    // {
    //     return $this->belongsTo(Status::class, 'status_id','id');
    // }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }


    public function pickup_location()
    {
        return $this->belongsTo(Pickup_Location::class, 'pickup_location_id','id');
    }

    public function delivery_country()
    {
        return $this->belongsTo(Location::class, 'delivery_country_id','id');
    }


    public function delivery_division()
    {
        return $this->belongsTo(Location::class, 'delivery_division_id','id');
    }

    public function delivery_district()
    {
        return $this->belongsTo(Location::class, 'delivery_district_id','id');
    }

    public function delivery_thana()
    {
        return $this->belongsTo(Location::class, 'delivery_thana_id','id');
    }

    public function delivery_area()
    {
        return $this->belongsTo(Location::class, 'delivery_area_id','id');
    }

    // public function coupon_id()

    // {
    //     if()
    //     return $this->belongsTo(Coupon::class, 'coupon_id','id');
    // }


}
