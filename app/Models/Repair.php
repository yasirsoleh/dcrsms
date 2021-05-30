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

    public function repairItems()
    {
        return $this->hasMany(repairItem::class)->withDefault();
    }
}
