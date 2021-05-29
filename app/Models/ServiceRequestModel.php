<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'device_name',
        'device_description',
        'picture',
        'approval_status',
        'rejection_reason',
        'customer_approval',
    ];
}
