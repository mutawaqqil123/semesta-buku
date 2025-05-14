<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $primaryKey = 'token_category';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_category', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_category';
    }

    public static function booted()
    {
        static::creating(function ($category){
            $category->token_category = Str::random(16);
        });

        static::updating(function ($category){
            $category->token_category = Str::random(16);
        });
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id', 'id');
    }
}
