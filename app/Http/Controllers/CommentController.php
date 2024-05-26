<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea){

        $validate = request()->validate([
            'content' => 'required|min:1'
        ]);

        $validate['idea_id'] = $idea->id;

        Comment::create($validate);

        return redirect()->route('ideas.show', $idea->id)->with('success', "Comment posted successfully!");
    }
}
