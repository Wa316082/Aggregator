<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'posted_by',
        'updated_by',

    ];

    public function sub_status(){
        return $this->hasMany(Status::class, 'status_group_id','id');
    }
}
