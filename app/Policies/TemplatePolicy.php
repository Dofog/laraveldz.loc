<?php

namespace App\Policies;

use App\Template;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function show(User $user,Template $template)
    {
        return $user->id === $template->created_by;
    }

    public function edit(User $user,Template $template)
    {
        return $user->id === $template->created_by;
    }

    public function destroy(User $user,Template $template)
    {
        return $user->id === $template->created_by;
    }
    
}
