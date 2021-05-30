<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
