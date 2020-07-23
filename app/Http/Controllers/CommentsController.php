<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Event;
use App\Comment;


class CommentsController extends Controller
{
  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
   protected function validator(array $data)
   {
       return Validator::make($data, [
           'comment' => ['required', 'string', 'max:2058'],
       ]);
   }

  /**
   * Show all the Comments.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

   /**
    * Create a new comment instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Event
    */
    public function create(Request $request)
    {
      // validators
      $this->validator($request->all())->validate();
      // create event
      $comment = $this->createComment($request->all());
      // redirect to
      return \Redirect::route('events.show', $event->id)->with('success', 'Commentaire sauvé!');
    }
   protected function createComment(array $data)
   {
       $comment = new Comment([
           'comment' => $data['comment'],
       ]);
       $comment = $comment->save();

       $comment->user()->associate($user);
       $comment->event()->associate($event);
       return $comment;
   }
}
