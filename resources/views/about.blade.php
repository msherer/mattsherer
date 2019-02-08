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
                        <div class="post-content">
                            <div class="entry-header text-center text-uppercase">
                                <h2>About Me</h2>
                            </div>
                            <div class="entry-content">
                                Coming Soon!
                            </div>
                        </div>
                    </article>

                </div>

                @include ('layouts.sidebar')

            </div>
        </div>
    </div>

@endsection

@section ('footer')

    @include ('layouts.footer')

@endsection