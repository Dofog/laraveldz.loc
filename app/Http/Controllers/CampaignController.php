<?php

namespace App\Http\Controllers;
use App\Campaign;
use App\Bunch;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignRequest;
use App\Template;
use Mail;


class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaigns = Campaign::latest()->owned()->get();

        foreach ($campaigns as $model){
            $model->template_id =  $model->templates()->value('name');
            $model->bunch_id =  $model->bunches()->value('name');
        }

        return view('campaign.index',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, CampaignRequest $request)
    {
        $campaign->create($request->all());
        return redirect()->route('campaign.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $this->authorize('show', $campaign);
        return view('campaign.show',compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('edit', $campaign);
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, CampaignRequest $request)
    {
        $campaign->update($request->all());
        return redirect()->route('campaign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $this->authorize('destroy', $campaign);
        $campaign->delete();
        return redirect()->route('campaign.index');
    }
    /**
     * @param Campaign $campaign
     */
    public function preview(Campaign $campaign)
    {
        $this->authorize('preview', $campaign);

            $title = $campaign->name;
            $message =  $campaign->templates()->value('content');
            $bunches = $campaign->bunches()->get();
            foreach ($bunches as $models){
                $subscribers = $models->subscribers()->get();
                foreach ($subscribers as $model) {
                    $emails[]=$model->email;
                }
            }
            $email= Auth::user()->email;

        if(empty($emails)===true){
            $emails[]='нету адресов';
        }
        

        if(count($emails)>200){
            array_slice($emails,0,200,true);
            $emails[200]='...';
        }

        return view('campaign.preview',compact('campaign','message','emails','email','title'));
    }
    public function send(Campaign $campaign)
    {
        $this->authorize('send', $campaign);

        $title = $campaign->name;
        $message =  $campaign->templates()->value('content');
        $content =  $message;
        $bunches = $campaign->bunches()->get();
        foreach ($bunches as $models){
            $subscribers = $models->subscribers()->get();
            foreach ($subscribers as $model) {
                $emails[]= $model->email;
            }
        }
        $email= Auth::user()->email;
        if(empty($emails)===true){
            $emails[]=$email;
        }
       Mail::send('email.send', ['content' => $content], function ($message) use ($email,$title,$emails)
        {

            $message->from(Auth::user()->email);
            $message->to($emails)->subject($title);

        });



        if(count($emails)>200){
            array_slice($emails,0,200,true);
            $emails[200]='...';
        }
        return redirect()->route('campaign.preview',compact('campaign','message','emails','email','title'));

    }



}
