<aside class="widget latest-post-widget">
    <h2 class="widget-title text-uppercase text-center">Latest Posts</h2>
    <ul>

        @foreach ($latestPosts as $post)

            <li class="media">
                <div class="media-left">
                    <a href="/posts/{{ $post->id }}" class="popular-img"><img style="width: 103px;" src="{{ URL::asset($post->image) }}" alt="">
                    </a>
                </div>
                <div class="latest-post-content">
                    <h2 class="text-uppercase"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                    <p>{{ $post->created_at->toFormattedDateString() }}</p>
                </div>
            </li>

        @endforeach

    </ul>
</aside>