<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AccessLog extends Model
{
    protected $table = 'access_logs';
    protected $primaryKey = 'token_access_log';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_access_log', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_access_log';
    }

    public static function booted()
    {
        static::creating(function ($logs){
            $logs->token_access_log = Str::random(16);
        });

        static::updating(function ($logs){
            $logs->token_access_log = Str::random(16);
        });
    }

    public function loans()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
}
