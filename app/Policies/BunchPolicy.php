<?php

namespace App\Policies;

use App\User;
use app\Bunch;

use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class BunchPolicy
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
    public function index(User $user,Bunch $bunch)
    {

        return Auth::user()->id == $bunch->updated_by;
    }

    public function show(User $user,Bunch $bunch)
    {
        return $user->id === $bunch->created_by;
    }



    public function edit(User $user,Bunch $bunch)
    {
        return $user->id === $bunch->created_by;
    }

    public function destroy(User $user,Bunch $bunch)
    {
        return $user->id === $bunch->created_by;

    }
}
