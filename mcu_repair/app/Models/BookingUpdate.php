<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class BookingUpdate extends Model
{
   protected $fillable =[
    'booking_id',
    'estimated_finish_date',
    'updated_note',
    'total_cost',
    'admin_id',
   ];


   public function admin(){
      return $this->belongsTo(User::class, 'admin_id');
   }
}
