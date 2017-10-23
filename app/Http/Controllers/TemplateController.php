<?php

namespace App\Http\Controllers;
use App\Http\Requests\TemplateRequest;
use App\Template;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Template $template)
    {
        $templates = Template::latest()->owned()->get();
        //$templates = $template->orderBy('id', 'asc')->get();
        // return view('post.index', ['posts' => $posts]);
        return view('template.index', compact('templates'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Template $template, TemplateRequest $request)
    {
        $template->create($request->all());
        return redirect()->route('template.index');
    }


    /**
     * @param Template $template

     */

    public function show(Template $template)
    {
        $this->authorize('show', $template);
            return view('template.show', compact('template'));

        
    }


    /**
     * @param Template $template

     */
    public function Edit(Template $template)
    {
        $this->authorize('edit', $template);
        return view('template.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TemplateRequest  $request
     * @param  Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        
        $template->update($request->all());
        return redirect()->route('template.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $this->authorize('destroy', $template);
        $template->delete();
        return redirect()->route('template.index');
    }
}
