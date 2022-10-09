<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function pronvice()
    {
        return $this->belongsTo(Pronvice::class);
    }

    public function garalley()
    {
        return $this->hasMany(Gallery::class);
    }

    public function logos()
    {
        return $this->belongsToMany(Logo::class)->withPivot('tenants')->withTimestamps();
    }

    


   
}
