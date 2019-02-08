<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Clearance {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * If user has this //permission
         */
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) {
            return $next($request);
        }

        /**
         * If user is creating a post
         */
        if ($request->is('posts/create')) {
            if (!Auth::user()->hasPermissionTo('Create Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /**
         * If user is editing a post
         */
        if ($request->is('posts/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /**
         * If user is deleting a post
         */
        if ($request->is('posts/*/delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /**
         * If user is creating a Spotify Widget
         */
        if ($request->is('spotify/create')) {
            if (!Auth::user()->hasPermissionTo('Create Widget')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /**
         * If user is editing a Spotify Widget
         */
        if ($request->is('spotify/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Widget')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /**
         * If user is deleting a Spotify Widget
         */
        if ($request->is('spotify/*/delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Widget')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}