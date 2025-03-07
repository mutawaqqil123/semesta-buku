<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $primaryKey = 'token_subs';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_subs', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_subs';
    }

    public static function booted()
    {
        static::updating(function ($subs){
            $subs->token_subs = Str::random(16);
        });

        static::creating(function ($subs){
            $subs->token_subs = Str::random(16);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'subscription_id', 'id');
    }
}
