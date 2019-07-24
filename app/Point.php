<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
