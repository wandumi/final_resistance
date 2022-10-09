<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresentationSection extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function presentation()
    {
        return $this->hasMany(Presentation::class);
    }
}
