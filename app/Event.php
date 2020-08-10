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
        'name', 'description', 'image', 'date', 'lat', 'lng', 'category_id',
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
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function eventsubcats()
    {
        return $this->hasMany('App\Eventsubcat');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($event) { // before delete() method call this
             $event->comments()->each(function($comment) {
                $comment->delete(); // <-- direct deletion
             });
             $event->participates()->each(function($participate) {
                $participate->delete(); 
             });
             // do the rest of the cleanup...
        });
    }


}
