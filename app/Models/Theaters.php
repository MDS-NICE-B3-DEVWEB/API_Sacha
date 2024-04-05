<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theaters extends Model
{
    use HasFactory;
    public function theater()
    {
        return $this->belongsTo(Show::class);
    }
    protected $table = 'theaters';
    protected $fillable = [
        'name',
        'adress',
        'SIRET',
    ];

}
