<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'token_profile';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_profile', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_profile';
    }

    public static function booted()
    {
        static::updating(function ($profile){
            $profile->token_profile = Str::random(16);
        });

        static::creating(function ($profile){
            $profile->token_profile = Str::random(16);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
