<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StatusGroup;

class Status extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'display_name',
        'status_group_id',
        'posted_by',
        'updated_by',
    ];

    public function status(){
        return $this->belongsTo(StatusGroup::class, 'status_group_id','id');
    }
}
