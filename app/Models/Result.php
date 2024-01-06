<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $casts = [
        'presence_recipients' => 'array'
    ];

    protected $guarded = ['id'];

    public function letter(){
        return $this->belongsTo(Letter::class);
    }

}
