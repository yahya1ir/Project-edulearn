<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    public function update(User $user, Course $course)
    {
        // Only formateur who owns the course or admin can edit
        return $user->role === 'admin' || ($user->role === 'formateur' && $user->id === $course->user_id);
    }

    public function delete(User $user, Course $course)
    {
        // Only formateur who owns the course or admin can delete
        return $user->role === 'admin' || ($user->role === 'formateur' && $user->id === $course->user_id);
    }

    public function create(User $user)
    {
        // Only formateur can create
        return $user->role === 'formateur';
    }

    public function view(User $user, Course $course)
    {
        // Everyone can view (student, formateur, admin)
        return true;
    }
}