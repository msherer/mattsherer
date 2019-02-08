<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function create()
    {
        return view('admin.sessions.create');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/admin');
    }

    public function store()
    {
        if(!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        return redirect('/admin')->with('flash_message', 'Welcome back!');
    }
}
