<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($user) {
            $user->profile()->create([
                'name' => $user->name,
                'image' => ''
            ]
            );
        });

        self::deleting(function($user) { // before delete() method call this
            $user->profile()->delete(); 
            $user->events()->each(function($event) {
               $event->delete(); 
            });
            $user->comments()->each(function($comment) {
                $comment->delete();
            });
        });
    }

    /**
     * Get the events from the user.
     */
    public function events()
    {
        return $this->hasMany('App\Event')->orderBy('created_at', 'DESC');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function participates()
    {
        return $this->hasMany('App\Participate');
    }
}
