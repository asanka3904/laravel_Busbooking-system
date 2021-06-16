<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus_schedule_bookings extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'bus_seate_id',
        'user_id',
        'bus_schedule_id',
        'seat_number',
        'price',
        'status'
    ];


   public function seates(){
       return $this->hasMany(bus_seates::class,'foreign_key');
   }


   public function user(){
    return $this->hasOne(User::class, 'foreign_key');
   }

   public function bus_shedule(){
    return $this->hasOne(bus_schedules::class, 'foreign_key');
   }
   
}
