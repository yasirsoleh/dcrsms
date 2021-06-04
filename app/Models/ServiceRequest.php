<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotation;
use App\Models\Repair;
use App\Models\PickUp;
use App\Models\Delivery;
use App\Models\Payment;

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

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
        //return Quotation::where('service_request_id', $this->id);
    }

    public function repair()
    {
        return $this->hasOne(Repair::class)->withDefault();
        //return Repair::firstWhere('service_request_id', $this->id);
    }

    public function pick_up()
    {
        return $this->hasOne(PickUp::class)->withDefault();
        //return PickUp::firstWhere('service_request_id', $this->id);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class)->withDefault();
        //return Delivery::firstWhere('service_request_id', $this->id);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class)->withDefault();
        //return Payment::firstWhere('service_request_id', $this->id);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
