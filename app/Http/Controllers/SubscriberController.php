<?php

namespace App\Http\Controllers;
use App\Http\Requests\SubscriberRequest;
use App\Subscriber;
use App\Bunch;
use Gate;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function index(Bunch $bunch,Subscriber $subscriber)
    {
        $subscribers = $bunch->subscribers()->get();


        if (Gate::denies('index', $bunch)) {
            abort(403,'This action is unauthorized.');
        }
        
        return view('subscriber.index', compact('bunch','subscribers','subscriber'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function create(Bunch $bunch,Subscriber $subscriber)
    {
        return view('subscriber.create',compact('bunch','subscriber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $subscriberRequest
     * @param Bunch $bunch
     * @return \Illuminate\Http\Response
     */
    public function store(Bunch $bunch , SubscriberRequest $subscriberRequest)
    {

       $bunch->subscribers()->create($subscriberRequest->all());
        return redirect()->route('subscriber.index',compact('bunch'));
    }
    /**
     * Display the specified resource.
     *
     * @param Bunch $bunch
     * @param  Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Bunch $bunch,Subscriber $subscriber) {

        if (Gate::denies('show',$bunch, $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        if (Gate::denies('show_next', $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        return view('subscriber.show', compact('bunch','subscriber'));

        //}

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch,Subscriber $subscriber)
    {
        if (Gate::denies('edit',$bunch, $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        if (Gate::denies('edit_next', $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        return view('subscriber.edit', compact('bunch','subscriber'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $subscriberRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Bunch $bunch,Subscriber $subscriber,SubscriberRequest $subscriberRequest )
    {
        
        $subscriber->update($subscriberRequest->all());
        return redirect()->route('subscriber.index',compact('bunch'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(Bunch $bunch,Subscriber $subscriber)
    {
        if (Gate::denies('destroy',$bunch, $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        if (Gate::denies('destroy_next', $subscriber)) {
            abort(403,'This action is unauthorized.');
        }
        $subscriber->delete();
        return redirect()->route('subscriber.index',compact('bunch'));
    }
}
