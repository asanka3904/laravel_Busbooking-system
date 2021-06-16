<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus_routes extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'route_id',
        'status',
        
    ];


    public function bus(){
        return $this->hasMany(bus::class,'foreign_key');
    }
 
 
    public function routes(){
     return $this->hasOne(routes::class, 'foreign_key');
    }

    public function bus_shedules()
    {
        return $this->belongsToMany(bus_shedules::class);
    }
}
