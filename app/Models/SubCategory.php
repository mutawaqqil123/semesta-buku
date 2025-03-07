<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Pest\Support\Str;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey = 'token_subcategory';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_subcategory', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_subcategory';
    }

    public static function booted()
    {
        static::creating(function ($subcategory){
            $subcategory->token_subcategory = Str::random(16);
        });

        static::updating(function ($subcategory){
            $subcategory->token_subcategory = Str::random(16);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category', 'sub_category_id', 'book_id', 'id', 'id');
    }
}
