<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const NORMAL = 1;
    public const ARTIST = 2;
    public const ADMIN = 3;

    protected $fillable = [
        'name',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
