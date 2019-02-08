<div class="comment-area">
    <div class="comment-heading">
        <h3>{{ count($post->comments) }} Thoughts</h3>
    </div>

    @foreach ($post->comments as $comment)
        <div class="single-comment">
            <div class="media">
                <div class="media-left text-center">
                    <a href=""><img class="media-object" src="{{ URL::asset('images/reply-1.jpg') }}" alt=""></a>
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <h3 class="text-uppercase">
                            <a href="">{{ $comment->name }}</a>
                            {{--<a href="" class="pull-right reply-btn">reply</a>--}}
                        </h3>
                    </div>
                    <p class="comment-date">
                        {{ $comment->created_at->format('F, d, Y \a\t g:i A') }}
                    </p>
                    <p class="comment-p">
                        {{ $comment->body }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>