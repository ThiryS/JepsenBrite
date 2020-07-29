<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;;

class ProfilesController extends Controller
{
   /**
    * Show all the events.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index(User $user)
   {
        return view('profiles/index', ['user' => $user]);
   }

   /**
    * Create a new event instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Event
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

       if(request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath],
        ));

       return \Redirect::route('profile.show', $user);
   }

   public function destroy($user)
   {
        $user = User::find($user);

        $user->delete();

       return \Redirect::route('home');
   }
}