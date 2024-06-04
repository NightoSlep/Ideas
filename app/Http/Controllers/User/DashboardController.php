<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::when(request()->has('search'), function ($query) {
            $query->search(request('search', ''));
        })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('dashboard', [
            'ideas' => $ideas,
        ]);
    }
}
