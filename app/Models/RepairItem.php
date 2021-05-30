<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'repair_id',
        'description',
        'cost'
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
