<?php
namespace App\Models;

class Book extends Model {
    protected $fillable = [
        'title',
        'page',
        'author',
        'price'
    ];
}