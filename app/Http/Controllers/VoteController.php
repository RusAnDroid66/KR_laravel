<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Vote;

class VoteController extends Controller
{
    public function showAll() {
        $votes = Vote::paginate(5);
        //$votes->["onEachside"] = 2;

        return view('index', ['votes' => $votes]);
    }

    public function create(Request $req) {
        $vote = new Vote;
        $vote->title = $req->title;
        $vote->text = $req->text;
        $vote->positive = 0;
        $vote->negative = 0;
        if ($req->file('img')->isValid()) {
            $path = $req->file('img')->store('images');
            $vote->img = Storage::url($path);
        }
        $vote->save();

        return redirect('/');
    }

    public function showVote($id) {
        $vote = Vote::where('id', $id)->first();

        return view('show_vote', ['vote' => $vote]);
    }

    public function increasePositive($id) {
        $vote = Vote::where('id', $id)->first();
        $vote->positive++;
        $vote->save();

        return back();
    }

    public function increaseNegative($id) {
        $vote = Vote::where('id', $id)->first();
        $vote->negative++;
        $vote->save();

        return back();
    }
}
