<aside class="widget widget-popular-post">
    <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
    <ul>

        @foreach ($popularPosts as $post)

            <li>
                <a href="/posts/{{ $post->id }}" class="popular-img"><img style="width: 300px;" src="{{ URL::asset($post->image) }}" alt=""></a>
                <div class="p-content">
                    <h4><a href="/posts/{{ $post->id }}" class="text-uppercase">{{ $post->title }}</a></h4>
                    <span class="p-date">{{ $post->created_at->toFormattedDateString() }}</span>
                </div>
            </li>

        @endforeach

    </ul>
</aside>