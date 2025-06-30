<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable =[
        'user_id',
        'category',
        'detail',
        'place',
        'fullName',
        'position',
        'personnel',
        'phone',
        'image_path',
        'status',
    ];
}
