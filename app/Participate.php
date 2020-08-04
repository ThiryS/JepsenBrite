<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    protected $table = 'participates';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
