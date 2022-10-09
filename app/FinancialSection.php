<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialSection extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function financial()
    {
        return $this->hasMany(Financial::class);
    }
}
