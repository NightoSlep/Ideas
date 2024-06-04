<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->is($model);
    }
    
    public function viewAdminDashboard(User $user): bool
    {
        Log::info('Checking viewAdminDashboard policy for user: ' . $user->id);
        Log::info('User is_admin: ' . $user->is_admin);
        return $user->is_admin===true;
    }
}
