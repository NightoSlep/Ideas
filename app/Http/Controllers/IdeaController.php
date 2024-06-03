<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{

    public function show(Idea $idea){
        return view('ideas.show', compact('idea'));
    }

    public function store(CreateIdeaRequest $createIdeaRequest){

        $validate = $createIdeaRequest->validated();

        $validate['user_id'] = auth()->id();
        
        Idea::create($validate);

        return redirect()->route('dashboard')->with('success', 'Idea created Successfully on My Own');
    }

    public function edit(Idea $idea){
        Gate::authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $updateIdeaRequest, Idea $idea){
        Gate::authorize('update', $idea);
        
        $validate = $updateIdeaRequest->validated();

        $idea->update($validate);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated Successfully');
    }
    

    public function destroy(Idea $idea){
        Gate::authorize('delete' , $idea);
        
        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully !');
    }

}
