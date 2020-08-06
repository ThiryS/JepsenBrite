<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Comment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adminEvents()
    {
        $events = Event::orderBy('date', 'desc')->paginate(30);

        return view('admin/adminEvents', ['events' => $events]);
        
    }

    public function destroyEvent($id)
    {
        $event = Event::find($id);
        $event->delete();

        return \Redirect::route('admin.event.show')->with('success', 'Event supprimé!');
    }

    public function adminUsers()
    {
        $users = User::orderBy('name')->paginate(30);

        return view('admin/adminUsers', ['users' => $users]);
    }

    public function destroyUser($id)
    {
        $user = User::find($id);

        $user->delete();

        return \Redirect::route('admin.users.show')->with('success', 'utilisateur supprimé!');
    }

    public function displayComments($id)
    {
        $event = Event::where('id', $id)->withCount('participates')->firstOrFail();

        return view('admin/adminComments', ['event' => $event]);
    }

    public function deleteComment($event_id, $id)
    {
        $comment = Comment::find($id); 

        $comment->delete();

        return \Redirect::route('admin.comments.show', $event_id)->with('success', 'commentaire supprimé!');
    }
}
