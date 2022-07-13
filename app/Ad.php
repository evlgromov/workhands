<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price'
    ];

    public function photos () {
        return $this->hasMany('App\Photo');
    }

    public function mainPhoto () {
        return $this->hasOne('App\Photo')->oldest();
    }
}
