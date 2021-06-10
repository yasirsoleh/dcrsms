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
    ];

    public function repair_item()
    {
        return $this->hasMany(RepairItem::class)->withDefault();
    }

    public function service_request()
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
