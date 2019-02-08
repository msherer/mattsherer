<article class="single-blog">
    <div class="post-thumb">
        <a href="/posts/{{ $post->id }}"><img style="width: 750px;" src="{{ URL::asset($post->image) }}" alt=""></a>
    </div>
    <div class="post-content">
        <div class="entry-header text-center text-uppercase">
            {{--<a href="" class="post-cat">Travel</a>--}}
            <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
        </div>
        <div class="entry-content">
            {!! $post->short_description !!}
        </div>
        <div class="continue-reading text-center text-uppercase">
            <a href="/posts/{{ $post->id }}">Continue Reading</a>
        </div>
        <div class="post-meta">
            <ul class="pull-left list-inline author-meta">
                <li class="author">By <a href="#">{{ $post->user->name }}</a></li>
                <li class="date">On {{ $post->created_at->toFormattedDateString() }}</li>
            </ul>
            <ul class="pull-right list-inline social-share">
                <li><a class="s-facebook" href="https://www.facebook.com/matt.sherer.33"><i class="fa fa-facebook"></i></a></li>
                <li><a class="s-twitter" href="https://twitter.com/sat_boodead"><i class="fa fa-twitter"></i></a></li>
                <li><a class="s-google-plus" href="https://plus.google.com/101192338504783742502?hl=en"><i class="fa fa-google-plus"></i></a></li>
                <li><a class="s-linkedin" href="https://www.linkedin.com/in/sherer/"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="s-twitch" href="https://www.twitch.tv/boodead"><i class="fa fa-twitch"></i></a></li>
            </ul>
        </div>
    </div>
</article>