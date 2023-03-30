<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight_table extends Model
{
    use HasFactory;

    public function box_name()
    {
        return $this->belongsTo(BoxSize::class, 'box_size', 'id');
    }
}
