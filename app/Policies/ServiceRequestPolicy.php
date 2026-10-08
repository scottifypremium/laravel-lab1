<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // any signed-in user
    }

    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->isAdmin() || $serviceRequest->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'student';
    }

    public function updateStatus(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->isAdmin();
    }
}