<?php

namespace App\Models;

use App\Models\BoxSize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\LogisticRateChart;
// use App\Models\LogisticZone;


class Logistic extends Model
{
    protected $guarded = [];
    use HasFactory;



    public function logistic_chart()
    {
        return $this->hasMany(LogisticRateChart::class, 'logistic_id', 'id');
    }

    // public function logistic_chart()
    // {
    //     return $this->hasMany(LogisticRateChart::class, 'logistic_id','id');
    // }

    public function logistic_id()
    {
        return $this->hasMany(LogisticZone::class, 'logistic_id', 'id');
    }


    public function box_size()
    {
        return $this->hasMany(BoxSize::class, 'logistic_id', 'id');
    }
}
