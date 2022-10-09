<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financial extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function financial_section()
    {
        return $this->belongsTo(FinancialSection::class);
    }
}
