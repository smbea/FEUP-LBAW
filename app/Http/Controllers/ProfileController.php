<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Event;
use App\Ticket;
use App\Category;
use App\Report;

class ProfileController extends Controller
{
    public function show() {
        if(Auth::check()){
            $user = Auth::user();

            $eventsOwned = Event::where('id_owner', $user->id_user)->get();
            
            $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
            $eventsAttending = [];

            foreach($userTickets as $ticket){
                array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
            }


            return view('pages.my-profile', ['user' => $user,
                                            'eventsOwned' => $eventsOwned, 
                                            'eventsAttending' => $eventsAttending,
                                            'categories' => Category::all()
                                            ]);
        } else return redirect('login');
                                        
    }

    public function showUser($id_user) {

        $user = User::find($id_user); //TODO: passar para findOrFail
        
        $followers = $user->followers()->count();
        $following = $user->following()->count();

        $isFollowing = null;

        if (Auth::check()) {
            $isFollowing = Auth::user()->following()->get()->contains($user);
        }

        $eventsOwned = Event::where('id_owner', $id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.profile',['user' => $user, 
                                    'eventsOwned' => $eventsOwned,
                                    'eventsAttending' => $eventsAttending, 
                                    'isFollowing' => $isFollowing,
                                    'categories' => Category::all()
                                    ]);
    }

    public function showEdit() {

        $user = Auth::user();

        $followers = $user->followers()->count();
        $following = $user->following()->count();

        $eventsOwned = Event::where('id_owner', $user->id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.edit-profile', 
                    ['user' => $user, 
                    'eventsOwned' => $eventsOwned, 
                    'eventsAttending' => $eventsAttending,
                    'categories' => Category::all()
                    ]);
    }


    protected function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:100',
            'description' => 'string|max:100',
        ])->validate();
    }

    public function update(Request $request) {

        if (!Auth::check()) 
                return redirect('home');
        
        $user = Auth::user();

        $this->validator($request->all());

        $user-> name = $request->input('name');
        $user-> username = $request->input('username');
        $user-> description = $request->input('description');
        $user->save();
        
        return redirect('profile');

    }

    public function remove(Request $request){
            if (!Auth::check()) 
                return redirect('home');

            $user = Auth::user();

            try {
                $user->delete();
                return redirect('home');
            } catch (Exception $e) {
                return redirect('profile');
            }
    }

    public function followUser($id) {

        if (!Auth::check()) 
            return response(403);
        
        $user1 = Auth::user();
        $user2 = User::findOrFail($id);

        try {
            $user1->following()->attach($user2);

        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }

    public function unfollowUser($id) {

        if (!Auth::check()) 
            return response(403);

        $user1 = Auth::user();
        $user2 = User::findOrFail($id);

        try {
            $user1->following()->detach($user2);
            $user2->followers()->detach($user1);
        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }

    public function ban($id_user){
        if (!Auth::check()) 
            return response(403);

        $user = User::find($id_user);

        $user->active = false;
        $user->save();
        return response(200);
    }


    public function report(Request $request, $id_user){
        if (!Auth::check()) 
            return response(403);

        $report  = Report::create([
            'reason' => $request->input('reason'),
            'report_type' => 'User'
        ]);

        DB::insert('insert into report_user (id_report, id_reporter, id_reported_user)  values (?, ?,?)', [$report->id_report, Auth::user()->id_user,$id_user]);
        return response(200);
    }
}

