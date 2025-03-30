<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;

class FeedbackPolicy
{
    public function view(User $user, Feedback $feedback): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Feedback $feedback): bool
    {
        return $user->isAdmin();
    }

    public function isEditable(User $user, Feedback $feedback): bool
    {
        return !$feedback->isAlreadyAcknowledged();
    }

}
