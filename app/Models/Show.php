<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;
    public function show()
    {
        return $this->belongsTo(Theaters::class);
    }
    protected $table = 'show';
    protected $fillable = [
        'title',
        'description',
        'price',
        'theatre_id',
    ];

}
