<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Intervention\Image\Facades\Image as Image;
use JD\Cloudder\Facades\Cloudder as Cloudder;
use App\Participate;
use App\Event;

class ProfilesController extends Controller
{
   /**
    * Show all the events.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index(User $user)
   {
       
       $eventsCreated = Event::where('user_id', $user->id)-> orderBy('date','DESC')-> paginate(10, ['*'], 'eCreated');

       $willParticipate = Participate::where('user_id', $user->id)-> whereHas('event', function ($query){
           $query ->where('date', '>', now());
       } ) -> paginate(10, ['*'], 'wParticipate');

       $hasParticipated= Participate::where('user_id', $user->id)-> whereHas('event', function ($query){
        $query ->where('date', '<', now()) -> orderBy('date', 'DESC') ;
        } ) -> paginate(10, ['*'], 'hParticipated');


        return view('profiles/index', ['user' => $user, 'eventsCreated' => $eventsCreated, 'willParticipate' => $willParticipate, 'hasParticipated' =>$hasParticipated]);
   }

   /**
    * Create a new event instance after a valid registration.
    */
   public function edit(User $user)
   {
       $this->authorize('update', $user->profile);

       return view('profiles/edit', ['user' => $user]);
   }

   public function update(User $user)
   {
       $data = request()->validate([
           'name' => 'required',
           'image' => ['nullable', 'image'],
       ]);

       if(request('image') != null)
        {
          Cloudder::upload(request('image'));
          $c=Cloudder::getResult();
          $imagePath = $c['url'];
        } else {
            $imagePath = $user->profile->image;
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));

        auth()->user()->update(['name' => $data['name']]);

       return \Redirect::route('profile.show', $user);
   }

   public function destroy($user)
   {
        $user = User::find($user);

        $user->delete();

       return \Redirect::route('home');
   }
}
