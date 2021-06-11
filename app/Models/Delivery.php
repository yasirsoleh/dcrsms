<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'rider_id',
        'service_request_id',
        'address',
        'cash_on_delivery',
        'status',
    ];

    public function rider()
    {
        return $this->belongsTo(Rider::class)->withDefault();
    }

    public function service_request()
    {
        return $this->belongsTo(ServiceRequest::class)->withDefault();
    }
}
