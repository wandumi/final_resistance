<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmtnPriceSupplements extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
