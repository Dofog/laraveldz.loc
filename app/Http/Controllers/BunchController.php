<?php

namespace App\Http\Controllers;
use App\Http\Requests\BunchRequest;
use App\Bunch;
use Illuminate\Http\Request;


class BunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bunch $bunch)
    {

        $bunches = Bunch::latest()->owned1()->get();

        foreach ($bunches as $model){
            $model->email =  $model->subscribers()->count();
        }
       
        //$templates = $template->orderBy('id', 'asc')->get();
        // return view('post.index', ['posts' => $posts]);
        return view('bunch.index', compact('bunches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('bunch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bunch $bunch, BunchRequest $request)
    {
        $bunch->create($request->all());
        return redirect()->route('bunch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bunch $bunch)
    {
        $this->authorize('show', $bunch);
        return view('bunch.show', compact('bunch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunch $bunch)
    {
        $this->authorize('edit', $bunch);
        return view('bunch.edit', compact('bunch'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BunchRequest $request, Bunch $bunch)
    {
        $bunch->update($request->all());
        return redirect()->route('bunch.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunch $bunch)
    {
        $this->authorize('destroy', $bunch);
        $bunch->delete();
        return redirect()->route('bunch.index');
    }
}
