<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\Customer;
use App\Models\Rider;
use App\Models\Staff;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class);
        //return Customer::firstWhere('user_id', $this->id);
    }

    public function rider()
    {
        return $this->hasOne(Rider::class);
        //return Rider::firstWhere('user_id', $this->id);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
        //return Staff::firstWhere('user_id', $this->id);
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function service_requests()
    {
        return $this->hasManyThrough(ServiceRequest::class, Customer::class);
    }
}
