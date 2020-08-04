<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Participate;
use App\Event;
use App\User;

class ParticipateController extends Controller
{

    public function show($id)
    {
        $event = Event::where('id', $id)->withCount('participates')->firstOrFail();
        // render the view with the event

        return view('events/participants', ['event' => $event]);
    }
    public function create(Request $request, $id)
    {
      $event = Event::find($id);

      $participate = $this->createParticipate($event);
      // redirect to
      return \Redirect::route('events.show', $event->id)->with('success', 'Participation sauvée!');
    }

    protected function createParticipate($event)
   {
       $participate = new Participate([
           
       ]);
       $user=Auth::user();

       $participate->user()->associate($user);
       $participate->event()->associate($event);
       $participate->save();

       return $participate;
   }
}
