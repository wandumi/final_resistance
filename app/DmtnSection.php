<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmtnSection extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function dmtn()
    {
        return $this->hasMany(Dmtn::class);
    }
}
