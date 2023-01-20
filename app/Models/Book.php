<?php
namespace App\Models;

class Book extends Model {
    protected $fillable = [
        'title',
        'page',
        'author',
        'price',
        'category_id'
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }

    public function modifylogs () {
        return $this->hasMany(Modifylog::class);
    }
}