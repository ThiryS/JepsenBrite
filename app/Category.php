<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];


    public function events()
    {
        return $this->hasMany('App\Event');
    }
    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }

}
