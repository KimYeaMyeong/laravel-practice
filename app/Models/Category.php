<?php
namespace App\Models;

class Category extends Model {
    protected $fillable = [
        'name',
        'brand_id'
    ];

    public function book () {
        return $this->hasMany(Book::class);
    }

    public function brand () {
        return $this->belongsTo(Brand::class);
    }

    public function scopeIsexist($query, $category_name, $brand_id){
        $query->where('name', $category_name)->where('brand_id', $brand_id);
    }
}