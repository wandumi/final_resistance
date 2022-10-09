<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portifolio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
