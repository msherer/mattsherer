@extends ('layouts.default')

@section ('header')

    @include ('layouts.header')

@endsection

@section ('content')

    <div class="kotha-default-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <article class="single-blog">
                        <div class="post-thumb">
                            <img src="{{ URL::asset($post->image) }}" alt="">
                        </div>
                        <div class="post-content">
                            <div class="entry-header text-center text-uppercase">
                                {{--<a href="" class="post-cat">Test</a>--}}
                                <h2>{{ $post->title }}</h2>
                            </div>
                            <div class="entry-content">
                                {!! $post->description !!}
                            </div>

                            <div class="post-meta">
                                <ul class="pull-left list-inline author-meta">
                                    <li class="author">By <a href="#">{{ $post->user->name }}</a></li>
                                    <li class="date"> On {{ $post->created_at->toFormattedDateString() }}</li>
                                </ul>
                                <ul class="pull-right list-inline social-share"><li><a class="s-facebook" href="https://www.facebook.com/matt.sherer.33"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="https://twitter.com/sat_boodead"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="https://plus.google.com/101192338504783742502?hl=en"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="https://www.linkedin.com/in/sherer/"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-twitch" href="https://www.twitch.tv/boodead"><i class="fa fa-twitch"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>

                    @include ('comments.comment')

                    @if (Auth::check())

                        @include ('comments.create')

                    @endif


                    {{--@include ('comments.top')--}}

                    {{--<div class="row">--}}

                        {{--@include ('posts.next')--}}

                        {{--@include ('posts.last')--}}

                    {{--</div>--}}

                    {{--@include ('posts.related')--}}

                </div>

                @include ('layouts.sidebar')

            </div>
        </div>
    </div>

@endsection

@section ('footer')

    @include ('layouts.footer')

@endsection