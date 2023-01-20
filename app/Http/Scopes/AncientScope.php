<?php

namespace App\Scopes;

use Illuminate\Databases\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AncientScope implements Scope {
    public function apply(Builder $builder, Model $model){
        $builder->where('book_id', 60);
    }
}