<?php

namespace App\Models;

use App\Casts\Base64;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Billable, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'address',
        'nationality',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'name' => Base64::class
    ];


    public function role()
    {
        // belongsTo o belongsToMany  => role_id 
        return $this->belongsTo(Role::class);
    }

    public function obras()
    {
        return $this->hasMany(Obra::class);
    }

    // Access to favorite_obra pivot table
    public function favoriteObras()
    {
        return $this->belongsToMany(Obra::class, 'favorite_obra');
    }

    // Access to to obra_user pivot table
    public function purchasedObras()
    {
        return $this->belongsToMany(Obra::class, 'obra_user')->withTimestamps();
    }

    public function getNameAttribute($name)
    {
        return ucfirst(base64_decode($name));
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = base64_encode($name);
    }
    //
    public function getEmailAttribute($email)
    {
        return base64_decode($email);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = base64_encode($email);
    }
    //

    // public function getTelephoneAttribute($telephone)
    // {
    //     return ucfirst(base64_decode($telephone));
    // }

    // public function setTelephoneAttribute($telephone)
    // {
    //     $this->attributes['telephone'] = base64_encode($telephone);
    // }
    //
    public function getAddressAttribute($address)
    {
        return ucfirst(base64_decode($address));
    }

    public function setAddressAttribute($address)
    {
        $this->attributes['address'] = base64_encode($address);
       
    }
    //
    public function getNationalityAttribute($nationality)
    {
        return ucfirst(base64_decode($nationality));
    }

    public function setNationalityAttribute($nationality)
    {
        $this->attributes['nationality'] = base64_encode($nationality);
    }
}
