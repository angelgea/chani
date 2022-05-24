<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Style\SymfonyStyle;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'price',
        'status_id',
        'style_id',    
        'user_id',
        'image_path',
    ];

    // $obra->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function markedAsFavoriteByUser()
    {
        return $this->belongsToMany(User::class, 'favorite_obra');
    }

    public function getDescriptionAttribute($description)
    {
        return ucfirst($description);
    }
}
