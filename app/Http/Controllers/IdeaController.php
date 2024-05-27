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

        $validate = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $validate['user_id'] = auth()->id();
        
        Idea::create($validate);

        return redirect()->route('dashboard')->with('success', 'Idea created Successfully on My Own');
    }

    public function edit(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $validate = request()->validate([
            'content' => 'required|min:3|max:240'
        ]);

        $idea->update($validate);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated Successfully');
    }
    

    public function destroy(Idea $idea){
        if(auth()->id() !== $idea->user_id){
            abort(404);
        }
        
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully !');
    }

}
