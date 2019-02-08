<!--leave comment-->
<div class="leave-comment">

    @include ('layouts.errors')

    <h4>Leave a reply</h4>
    <form class="form-horizontal contact-form" method="POST" action="/posts/{{ $post->id }}/comments">

        {{ csrf_field() }}

        {{--<div class="form-group">--}}
            {{--<div class="col-md-6">--}}
                {{--<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>--}}
            {{--</div>--}}

            {{--<div class="col-md-6">--}}
                {{--<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<div class="col-md-12">--}}
                {{--<input type="text" class="form-control" id="subject" name="subject" placeholder="Website url">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-md-12">
                <textarea class="form-control" rows="6" name="body" placeholder="Write Massage" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>