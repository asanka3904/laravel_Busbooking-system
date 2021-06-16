<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus_seates extends Model
{
    use HasFactory;

    protected $fillable=[
        'bus_id',
        'seat_number',
        'price'
    ];

    public function bus_seates(){
        return $this->belongsTo(bus_schedule_bookings::class);
    }
}
