<?php

namespace App\Http\Controllers\Admin\Spotify;

use App\Spotify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Spotify::all();

        return view('admin.spotify.index')->with('widgets', $widgets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spotify.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'client_id' => 'required',
            'client_secret_id' => 'required',
            'redirect_uri' => 'required'
        ]);

        Spotify::create(request(['name', 'client_id', 'client_secret_id', 'redirect_uri']));

        return redirect('/admin/spotify');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function show(Spotify $spotify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function edit(Spotify $spotify)
    {
        return view('admin.spotify.edit', compact('spotify'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spotify $spotify)
    {
        $widget = Spotify::findOrFail($spotify->id);
        $this->validate($request, [
            'name' => 'required',
            'client_id' => 'required',
            'client_secret_id' => 'required',
            'redirect_uri' => 'required'
        ]);

        $widget->fill(request(['name', 'client_id', 'client_secret_id', 'redirect_uri']))->save();

        return redirect()->route('spotify.index')
            ->with('flash_message',
                'Widget deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spotify  $spotify
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $widget = Spotify::findOrFail($id);
        $widget->delete();

        return redirect('/admin/spotify');
    }

    public function callback(Request $request)
    {
        dd($request);
    }
}
