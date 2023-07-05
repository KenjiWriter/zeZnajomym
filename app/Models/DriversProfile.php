<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversProfile extends Model
{
    protected $table = 'drivers_profiles';
    protected $fillable = [
        'name',
        'postcode',
        'code',
        'street',
        'city',
        'price_type',
        'price_per_km',
        'avg_fuel_con',
        'fuel_price',
        'zones',
    ];
    use HasFactory;
}
