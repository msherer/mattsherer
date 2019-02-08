<?php

namespace App\Http\Controllers\Admin;

use App\VideoGames;
use App\VideoGameEntity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoGamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoGameEntity = new VideoGameEntity();
        $collection = VideoGameEntity::with('entityInt')->get();
        $videoGameEntity->addAttributeValues($collection);
        $collection = $videoGameEntity->getData();

        dd($collection);

        return view('admin.videogames.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoGames  $video_games
     * @return \Illuminate\Http\Response
     */
    public function show(VideoGames $video_games)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoGames  $video_games
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoGames $video_games)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoGames  $video_games
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoGames $video_games)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoGames  $video_games
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoGames $video_games)
    {
        //
    }
}
