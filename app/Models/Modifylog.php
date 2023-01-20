<?php
namespace App\Models;

use App\Scopes\AncientScope;

class Modifylog extends Model {
    protected $fillable = [
        'log',
        'user_id',
        'book_id'
    ];

    public function book () {
        return $this->belongsTo(Book::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    // public function booted() {
    //     static::addGlobalScope(new AncientScope);
    // }

    public function scopeSelectlog($query, $type){
        $query->where('book_id', $type);
    }
}