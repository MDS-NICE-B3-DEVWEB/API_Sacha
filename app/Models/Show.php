<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;
    public function Theaters()
    {
        return $this->belongsTo(Theaters::class);
        
    }
    
public function comments()
{
    return $this->hasMany(Comment::class);
}
    protected $table = 'show';
    protected $fillable = [
        'title',
        'description',
        'price',
        'theatre_id',
    ];
}
