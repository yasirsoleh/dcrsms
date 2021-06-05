<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'status',
    ];

    public function service_requests()
    {
        return $this->hasMany(ServiceRequest::class)->withDefault();
        //return ServiceRequest::where('customer_id', $this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        //return User::firstWhere('id', $this->user_id);
    }

    public function pick_ups()
    {
        return $this->hasManyThrough(PickUp::class,ServiceRequest::class);
    }

    public function deliveries()
    {
        return $this->hasManyThrough(Delivery::class,ServiceRequest::class);
    }

    public function repair()
    {
        //
    }

}
