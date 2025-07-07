<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingUpdate extends Model
{
   protected $fillable =[
    'booking_id',
    'estimated_finish_date',
    'updated_note',
    'total_cost',
   ];
}
