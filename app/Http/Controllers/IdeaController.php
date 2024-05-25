<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Redirect;

class IdeaController extends Controller
{

    public function show(Idea $idea){
        return view('ideas.show', compact('idea'));
    }

    public function store(){

        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);
        
        $idea = Idea::create([
            'content' => request()->get('idea',''),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea created Successfully on My Own');
    }

    public function edit(Idea $idea){
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea){

        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->content = request()->get('content','');
        $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated Successfully');
    }
    

    public function destroy(Idea $idea){
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully !');
    }
}
