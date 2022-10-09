<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function presentation_section()
    {
        return $this->belongsTo(PresentationSection::class);
    }
}
