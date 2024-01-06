<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter_type extends Model
{

    protected $guarded = ['id'];

    use HasFactory;

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}
