<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'token_book';
    protected $keyType = 'string';
    protected $guarded = ['id', 'token_book', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'token_book';
    }

    public static function booted()
    {
        static::creating(function ($book){
            $book->token_book = Str::random(16);
        });

        static::updating(function ($book){
            $book->token_book = Str::random(16);
        });
    }

    public function subcategory()
    {
        return $this->belongsToMany(SubCategory::class, 'book_category', 'book_id', 'sub_category_id', 'id', 'id')->withPivot('sub_category_id');
    }

}
