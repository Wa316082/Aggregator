<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Logistic;
use App\Models\Location;

class LogisticZone extends Model
{
    protected $guarded=[];
    use HasFactory;

    // public function getCountry($value)
    // {
    //     $ids = $this->attributes['id'] = json_decode($value);
    // }
    // public function countries()
    // {
    //     $country_ids= json_decode($this->country_id);
    //     return $this->hasMany(Location::class)->whereIn('id',$country_ids);
    // }


    //     public function country()
    // {
    //     return Location::find($this->country_id);
    // }


    public function logistic()
    {
        return $this->belongsTo(Logistic::class, 'logistic_id','id');
    }

    // public function country()

    // {

    //     return $this->belongsTo(Location::class, 'country_id','id');
    // }



}
