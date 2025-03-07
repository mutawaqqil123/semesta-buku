<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'categories';
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

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
