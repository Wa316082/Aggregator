<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Logistic;

class LogisticRateChart extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function logisticsid(){
        return $this->belongsTo(Logistic::class, 'logistic_id','id');
    }

    // public function countryId(){
    //     return $this->belongsTo(Logistic::class, 'country_id','id');
    // }


}
