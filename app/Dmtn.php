<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dmtn extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function dmtn_section()
    {
        return $this->belongsTo(DmtnSection::class);
    }
}
