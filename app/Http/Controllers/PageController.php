<?php

namespace App\Http\Controllers;

use App\Models\CMSPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = CMSPage::all();
        return view('layout.admin.cmspage.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.admin.cmspage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'page_name' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_content' => 'required|string',
            'status' => 'required|in:1,0',
        ]);

        CMSPage::create($validatedData);

        return redirect()->route('cmspages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CMSPage  $page
     * @return \Illuminate\Http\Response
     */
    public function show(CMSPage $cmspage)
    {
        
        $page = $cmspage;
        return view('layout.admin.cmspage.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(CMSPage $cmspage)
    {
        $page = $cmspage;
       // dd($page);
        return view('layout.admin.cmspage.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CMSPage $cmspage)
    {
        $validatedData = $request->validate([
            'page_name' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        $cmspage->update($validatedData);

        return redirect()->route('cmspages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(CMSPage $cmspage)
    {
        $cmspage->delete();

        return redirect()->route('cmspages.index')->with('success', 'Page deleted successfully.');
    }
}