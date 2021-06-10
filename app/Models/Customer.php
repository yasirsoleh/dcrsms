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
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pick_ups()
    {
        return $this->hasManyThrough(PickUp::class,ServiceRequest::class);
    }

    public function deliveries()
    {
        return $this->hasManyThrough(Delivery::class,ServiceRequest::class);
    }

    public function repairs()
    {
        return $this->hasManyThrough(Repair::class, ServiceRequest::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, ServiceRequest::class);
    }

}
