<?php

namespace App\Policies;

use App\Campaign;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
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

    public function show(User $user,Campaign $campaign)
    {
        return $user->id === $campaign->created_by;
    }

    public function edit(User $user,Campaign $campaign)
    {
        return $user->id === $campaign->created_by;
    }

    public function destroy(User $user,Campaign $campaign)
    {
        return $user->id === $campaign->created_by;
    }

    public function preview(User $user,Campaign $campaign)
    {
        return $user->id === $campaign->created_by;
    }

    public function send(User $user,Campaign $campaign)
    {
        return $user->id === $campaign->created_by;
    }
}
