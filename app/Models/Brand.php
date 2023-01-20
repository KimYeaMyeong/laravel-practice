<?php
namespace App\Models;

class Brand extends Model {
    protected $fillable = [
        'name'
    ];

    public function category () {
        return $this->hasMany(Category::class);
    }
}