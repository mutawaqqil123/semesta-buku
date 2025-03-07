<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'token_trans';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_trans', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_trans';
    }

    public static function booted()
    {
        static::updating(function ($trans){
            $trans->token_trans = Str::random(16);
        });

        static::creating(function ($trans){
            $trans->token_trans = Str::random(16);
        });
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'id');
    }
}
