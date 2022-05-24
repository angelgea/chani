<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const AVAILABLE = 1;
    public const SOLD = 2;

    public function obra()
    {
        return $this->hasOne(Status::class);
    }
}
