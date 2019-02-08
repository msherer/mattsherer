<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Session;
use App\Spotify;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::latest()->get();
        //$spotifyRecord = Spotify::where('id', '=', 2)->first()->toArray();
        //$spotify = new Spotify($spotifyRecord);
        //$spotifyTrack = $spotify->requestCurrentPlayingTrack();
        $spotifyTrack = '';

        return view('posts.index', compact('posts', 'spotifyTrack'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll($id)
    {
        $posts = Post::where('user_id', '=', $id)->get();

        return view('posts.list', compact('posts'));
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Post $post)
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'image' => 'nullable'
        ]);

        $post->update(request(['title', 'description', 'short_description', 'image']));

        return redirect('/posts/list/' . $post->user_id);
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Post $post)
    {
        $post->delete();

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'image' => 'nullable'
        ]);

        auth()->user()->publish(
            new Post(request(['title', 'description', 'short_description', 'image']))
        );

        return redirect('/');
    }
}
