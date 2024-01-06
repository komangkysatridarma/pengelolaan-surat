<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{

    protected $guarded = ['id'];
    protected $casts = [
        'recipients' => 'array'
    ];

    use HasFactory;

    public function letter_type(){
        return $this->belongsTo(Letter_type::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public static function countUsageByType($letterTypeId)
    {
        return self::where('letter_type_id', $letterTypeId)->count();
    }
}
