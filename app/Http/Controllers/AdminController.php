<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;
use JD\Cloudder\Facades\Cloudder as Cloudder;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    //Event functions

    protected function eventValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2058'],
            'date' => ['required', 'date'],
            'category' => ['required', 'string'],
            'image' => 'nullable'
        ]);
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

    public function adminEventEdit($id)
    {
        $event = Event::find($id);
        return view('admin/adminEventEdit', ['event' => $event]);
    }

    public function adminEventUpdate(Request $request, $id)
    {
        $data = $this->eventValidator($request->all())->validate();
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
        } 
        else 
        {
            $imagePath = $event->image;
        }

        $event->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));

        return \Redirect::route('admin.event.show')->with('success', 'Event modifié!');

    }
    
    
    //User functions

    public function adminUsers()
    {
        $users = User::orderBy('name')->paginate(30);

        return view('admin/adminUsers', ['users' => $users]);
    }

    public function adminUserEdit($id)
    {
    //    $this->authorize('update', $user->profile);
        $user = User::find($id);

        return view('admin/adminUserEdit', ['user' => $user]);
    }

    public function adminUserUpdate($id)
    {
        $user=User::find($id);
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

        $user->profile->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));

        $user->update(['name' => $data['name']]);

       return \Redirect::route('admin.users.show')->with('success', 'Profil modifié!');;
    }


    public function destroyUser($id)
    {
        $user = User::find($id);

        $user->delete();

        return \Redirect::route('admin.users.show')->with('success', 'utilisateur supprimé!');
    }

    //Comments functions

    protected function commentValidator(array $data)
    {
       return Validator::make($data, [
           'comment' => ['required', 'string', 'max:2058'],
       ]);
    }

    public function displayComments($id)
    {
        $event = Event::where('id', $id)->withCount('participates')->firstOrFail();
        $comments = Comment::where ('event_id', $id) -> paginate(20);

        return view('admin/adminComments', ['event' => $event, 'comments' => $comments]);
        
    }

    public function adminCommentEdit($event_id, $id)
    {
        $event= Event::find($event_id);
        $comment = Comment::find($id);
        return view('admin/adminCommentEdit', ['event' => $event, 'comment' => $comment]);
    }

    public function adminCommentUpdate(REQUEST $request, $event_id, $id)
    {
        $data = $this->commentValidator($request->all())->validate();
        $comment = Comment::find($id);
        $comment -> comment = $request -> get('comment');
        $comment->update(['comment' => $data['comment']]);

        return \Redirect::route('admin.comments.show', $event_id)->with('success', 'Commentaire modifié!');
    }

    public function deleteComment($event_id, $id)
    {
        $comment = Comment::find($id); 

        $comment->delete();

        return \Redirect::route('admin.comments.show', $event_id)->with('success', 'commentaire supprimé!');
    }
}
