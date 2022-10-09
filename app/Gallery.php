<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
