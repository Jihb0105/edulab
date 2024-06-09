<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveChat;
// use App\Http\Traits\MeetingZoomTrait;
use App\Http\Traits\UseZoom;
use MacsiDigital\Zoom\Facades\Zoom;

class LiveChatController extends Controller
{
    // use MeetingZoomTrait;
    use UseZoom;

    public function index()
    {
        $liveChats = LiveChat::where('user_id', auth()->user()->id)->paginate(20);

        if(auth()->user()->type == 'admin'){
            return view('admins.livechats.index', compact('liveChats'));
        }elseif(auth()->user()->type == 'lecturer'){
            return view('lecturers.livechats.index', compact('liveChats'));
        }
    }
    
    public function store(Request $request)
    {
        $meeting = $this->createMeeting($request);
        $meeting_det = json_decode($meeting, true);

        LiveChat::create([
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting_det['id'],
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting_det['duration'],
            'password' => $meeting_det['password'],
            'start_url' => $meeting_det['start_url'],
            'join_url' => $meeting_det['join_url']
        ]);
            
        return redirect()->back()->with('message', 'Meeting call has been created.');
    }
    
    public function destroy(Request $request)
    {
        $meeting = Zoom::meeting()->find($request->id);
        $meeting->delete();
        LiveChat::where('meeting_id', $request->id)->delete();

        return redirect()->back()->with('message', 'Meeting have been deleted.');
    }
    
}
