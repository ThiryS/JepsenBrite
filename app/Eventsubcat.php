<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventsubcat extends Model
{
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
