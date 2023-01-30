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

    public function scopeFindByBrandId($query, $brand_id) {
        $query->where('brand_id', $brand_id);
    }

    public function scopeFindByCategoryName($query, $category_name){
        $query->where('name', $category_name);
    }

    public function scopeFindOne($query, $category_name, $brand_id){
        $query->where('name', $category_name)->where('brand_id', $brand_id);
    }
}