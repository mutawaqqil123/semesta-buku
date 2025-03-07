<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plan extends Model
{
    protected $table = 'plans';
    protected $primaryKey = 'token_plan';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_plan', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_plan';
    }

    public static function booted()
    {
        static::updating(function ($plan){
            $plan->token_plan = Str::random(16);
        });

        static::creating(function ($plan){
            $plan->token_plan = Str::random(16);
        });
    }

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'plan_id', 'id');
    }
}
