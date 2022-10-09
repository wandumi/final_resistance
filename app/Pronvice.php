<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pronvice extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
