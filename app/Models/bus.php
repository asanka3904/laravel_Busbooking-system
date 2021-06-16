<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
         'type',
         'vehical_number'
    ];


    public function bus_routes()
    {
        return $this->belongsTo(bus_routes::class);
    }
}
