<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bbbee extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
