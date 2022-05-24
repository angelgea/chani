<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;

    protected $fillable = ['name','image_path'];

    public function obras(){
        return $this->hasMany(Obra::class);
    }

    // // get|FirstName|Attribute
    // // first_name => columna
    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
