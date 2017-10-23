<?php

namespace App\Policies;
use App\Subscriber;
use App\Bunch;
use app\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class SubscriberPolicy
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


    public function show(Bunch $bunch)
    {

        return Auth::user()->id === $bunch->created_by;
    }

    public function show_next(User $user,Subscriber $subscriber)
    {

        return Auth::user()->id === $subscriber->created_by;
    }


    public function edit(Bunch $bunch)
    {

        return Auth::user()->id === $bunch->created_by;
    }

    public function edit_next(User $user,Subscriber $subscriber)
    {

        return Auth::user()->id === $subscriber->created_by;
    }

    public function destroy(Bunch $bunch)
    {

        return Auth::user()->id === $bunch->created_by;
    }

    public function destroy_next(User $user,Subscriber $subscriber)
    {

        return Auth::user()->id === $subscriber->created_by;
    }
}
