<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_request_id',
        'status',
        'reason',
    ];

    public function repair_items()
    {
        return $this->hasMany(RepairItem::class);
    }

    public function service_request()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
