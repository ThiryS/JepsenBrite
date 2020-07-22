<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'date', 'lat', 'lng',
    ];

    /**
     * Get the user record associated with the event.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function create($event)
    {

    }
}
