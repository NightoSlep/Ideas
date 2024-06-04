<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();

        // Gate::authorize('viewAdminDashboard', $user);
        if (Gate::allows('viewAdminDashboard', $user)) {
            return view('admin.dashboard');
        } else {
            abort(403, 'Unauthorized action.');
        }
        

    }
}
