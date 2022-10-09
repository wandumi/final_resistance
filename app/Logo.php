<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logo extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('tenants')->withTimestamps();
    }

    
}
