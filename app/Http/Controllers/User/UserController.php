<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('user.show', compact('user', 'ideas'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $ideas = $user->ideas()->paginate(5);

        return view('user.edit', compact('user', 'ideas'));
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        Gate::authorize('update', $user);
        
        $validated = $updateUserRequest->validated();

        if($updateUserRequest->has('image')){
            $imagePath = $updateUserRequest->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
