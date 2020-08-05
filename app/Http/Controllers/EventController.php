<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Pagination\Paginator;
use JD\Cloudder\Facades\Cloudder as Cloudder;
use App\Participate;
use App\Event;
use App\Comment;

class EventController extends Controller
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
             'name' => ['required', 'string', 'max:255'],
             'description' => ['required', 'string', 'max:2058'],
             'date' => ['required', 'date'],
             'category' => ['required', 'string'],
             'image' => 'nullable'
         ]);
     }

    /**
     * Show all the events.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve events from db using eloquent
        $events = Event::all();
        // render the view with the events
        return view('events/index', ['events' => $events]);
    }

    public function indexWelcome()
    {
        // Retrieve events from db using eloquent
        $events = Event::where('date', '>=',  now())->orderBy('date', 'asc')->paginate(21);
        // render the view with the events
        return view('welcome', ['events' => $events]);
    }

    public function find($id)
    {
        $event = Event::where('id', $id)->withCount('participates')->firstOrFail();
        // render the view with the event
        return view('events/show', ['event' => $event]);
    }

    public function create()
    {
        return view('events/create');
    }

    /**
     * Create a new event instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Event
     */
    protected function store(Event $event)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'category' => 'required',
            'image' => ['nullable', 'image']
        ]);

        if(request('image') != null)
        {
          Cloudder::upload(request('image'));
          $c=Cloudder::getResult();
          $imagePath = $c['url'];

        }else{
            $imagePath = "./event.jpg";
        };

        Auth::user()->events()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'date' => $data['date'],
            'category' => $data['category'],
            'image' => $imagePath
        ]);

        return redirect('/events/'.$event->id)->with('success', 'Event créé!');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validator($request->all())->validate();
        $event = Event::find($id);
        $event->name =  $request->get('name');
        $event->description = $request->get('description');
        $event->date = $request->get('date');
        $event->category = $request->get('category');


        if(request('image') != null)
         {
           $event->image = $request->get('image');
           Cloudder::upload(request('image'));
           $c=Cloudder::getResult();
           $imagePath = $c['url'];
         } else {
             $imagePath = $event->image;
         }

        $event->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));

        return \Redirect::route('events.show', $event->id)->with('success', 'Event modifié!');

    }
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return \Redirect::route('events.index')->with('success', 'Event supprimé!');
    }
}
