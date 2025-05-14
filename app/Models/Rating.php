<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $primaryKey = 'token_rating';
    protected $keyType = 'string';
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'token_rating';
    }

    public static function booted()
    {
        static::creating(function ($rating){
            $rating->token_rating = Str::random(16);
        });

        static::updating(function ($rating){
            $rating->token_rating = Str::random(16);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
