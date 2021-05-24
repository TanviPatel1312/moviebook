<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCasts extends Model
{
    use HasFactory;

    protected $fillable = [
        'c_id',
        'm_id',
    ];
}
