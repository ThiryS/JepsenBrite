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
      $user=Auth::user();
      $participateB = Participate::where('user_id', $user->id)->where('event_id', $id)->get();
      if (count($participateB)) {
        return \Redirect::route('events.show', $event->id)->with('warning', 'Vous participez déjà à l\'événement!');
      }else {
        $participate = $this->createParticipate($event);
        // redirect to
        return \Redirect::route('events.show', $event->id)->with('success', 'Participation sauvée!');
      }
      
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

   public function destroy($id)
    {
      $event = Event::find($id);
      $user=Auth::user();
      $participate = Participate::where('user_id', $user->id)->where('event_id', $id)->get();
      if (count($participate) > 0) {
        $participate = Participate::where('user_id', $user->id)->where('event_id', $id);
        $participate->delete();
        // redirect to
        return \Redirect::route('events.show', $event->id)->with('success', 'Participation effacée!');
      }else {
        
        return \Redirect::route('events.show', $event->id)->with('warning', 'Vous ne participez pas à l\'événement!');
      }
      
    }
}
