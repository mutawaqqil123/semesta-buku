<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'token_blog';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_blog', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_blog';
    }

    public static function booted()
    {
        static::creating(function ($blog) {
            $blog->token_blog = Str::random(16);
        });

        static::updating(function ($blog) {
            $blog->token_blog = Str::random(16);
        });
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
