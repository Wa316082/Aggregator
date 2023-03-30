<?php

namespace App\Models;

use App\Models\Logistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoxSize extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function logistics_Id()
    {
        return $this->belongsTo(Logistic::class, 'logistic_id', 'id');
    }
}
