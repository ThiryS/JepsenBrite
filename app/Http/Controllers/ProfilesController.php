<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

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
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
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
