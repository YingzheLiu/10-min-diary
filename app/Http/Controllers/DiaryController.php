<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\EmojiIcon;
use App\Rules\HasntPostToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::where('user_id', '=', Auth::user()->id)->get();
        return view('diary.index', [
            'diaries' => $diaries,
        ]);
    }
    public function create()
    {
        $emojis = DB::table('emoji_icons')->get();
        return view('diary.create', [
            'emojis' => $emojis,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|maxwords:100',
            'emoji' => 'required|exists:emoji_icons,id',
        ]);

        $request->validate([
            'content' => [new HasntPostToday],
        ]);

        Diary::create([
            'content' => $request->input('content'),
            'emoji_icon_id' => $request->input('emoji'),
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Successfully post a diary!',
            'alert-type' => 'success'
        );

        return redirect()
            ->route('diary.index')
            ->with($notification);
    }

    public function edit($id)
    {
        $diary = Diary::find($id);
        $emojiIcons = EmojiIcon::get();

        if (Gate::denies('edit-diary', $diary)) {
            abort(403);
        }
        return view('diary.edit', [
            'diary' => $diary,
            'emojiIcons' => $emojiIcons,
        ]);
    }

    public function update($id, Request $request)
    {
        $diary = Diary::find($id);

        $request->validate([
            'content' => 'required|maxwords:100',
            'emoji' => 'required|exists:emoji_icons,id',
        ]);

        // UPDATING
        $diary->content = $request->input('content');
        $diary->emoji_icon_id = $request->input('emoji');
        $diary->updated_at = now();
        $diary->save();

        $notification = array(
            'message' => 'Successfully update the diary',
            'alert-type' => 'success'
        );

        return redirect()
            ->route('diary.index')
            ->with($notification);
    }

    public function deleteConfirmation($id)
    {
        $diary = Diary::find($id);

        return view('diary.deleteConfirmation', [
            'diary' => $diary,
        ]);
    }

    public function delete($id)
    {
        $diary = Diary::find($id);
        $date = $diary->created_at->format('m/d/Y');
        $diary->delete();

        $notification = array(
            'message' => 'Successfully delete the diary on ' + $date,
            'alert-type' => 'success'
        );

        return redirect()
            ->route('diary.index')
            ->with($notification);
    }
}
