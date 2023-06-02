<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Topic::where('user_id', Auth::id())->get();
        $topics = $topics->groupBy('pinned');
        dd($topics);
        return view('topic', [
            'topics' => $topics
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $topic = null;
        if ($request->topic) {
            $topic = Topic::find($request->topic);
        }

        if ($topic == null) {
            $topic = new Topic([
                'user_id' => Auth::id(),
                'title' => $request->title,
            ]);
        }
        
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->pinned = $request->pinned ? 1 : 0;
        $topic->chat_session_id = $request->pinned ?? 0;


    }
}
