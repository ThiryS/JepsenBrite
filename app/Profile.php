<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : "default_profile.jpg";

        return $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
