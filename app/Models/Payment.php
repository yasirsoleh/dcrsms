<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_request_id',
        'type',
        'amount',
        'status',
    ];

    public function service_request()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
