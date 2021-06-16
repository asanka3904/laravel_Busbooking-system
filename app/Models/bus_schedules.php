<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus_schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_route_id',
        'direction',
        'start_timestamp',
        'end_timestamp',
    ];
    

    
    public function bus_shedule(){
        return $this->belongsTo(bus_schedule_bookings::class);
    }
}
