<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //session()->flash('message', 'Thanks so much for signing up!');

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll($id)
    {
        $posts = Post::where('user_id', '=', $id)->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
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

        return redirect('/admin/posts');
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('flash_message',
                'Post deleted!');
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

        return redirect('/admin/posts');
    }
}
