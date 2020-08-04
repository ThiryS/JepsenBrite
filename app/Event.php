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
        'name', 'description', 'image', 'date', 'lat', 'lng', 'category',
    ];
    /**
     * Get the user record associated with the event.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function participates()
    {
        return $this->hasMany('App\Participate');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($event) { // before delete() method call this
             $event->comments()->each(function($comment) {
                $comment->delete(); // <-- direct deletion
             });
             // do the rest of the cleanup...
        });
    }


}
