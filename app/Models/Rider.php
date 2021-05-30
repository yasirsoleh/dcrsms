<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'roadtax',
        'license',
        'status',
    ];

    public function pick_ups()
    {
        return $this->hasMany(PickUp::class)->withDefault();
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
