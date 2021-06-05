<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUp extends Model
{
    use HasFactory;
    protected $fillable = [
        'rider_id',
        'service_request_id',
        'address',
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
