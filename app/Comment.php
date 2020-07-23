<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'comment',
  ];

  /**
   * Get the user record associated with the event.
   */
  public function user()
  {
      return $this->belongsTo('App\User');
  }
  public function event()
  {
      return $this->belongsTo('App\Event');
  }

  /**
 * The has Many Relationship
 *
 * @var array
 */

  public function create($comment)
  {

  }
}
