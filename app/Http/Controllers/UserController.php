<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $ideas = $user->ideas()->paginate(5);

        return view('user.edit', compact('user', 'ideas'));
    }

    public function update(User $user)
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:2',
                'bio' => 'nullable|min:1|max:255',
                'image' => 'image',
            ]
        );

        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile', 'public');
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
