@extends ('layouts.default')

@section ('header')

    @include ('layouts.header')

@endsection

@section ('content')

    <div class="container">

        @include ('layouts.carousel')

        @include ('posts.moments')

    </div>
    <div class="kotha-default-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">

                    @foreach ($posts as $post)

                        @include ('posts.post')

                    @endforeach

                </div>

                @include ('layouts.sidebar')

            </div>
        </div>
    </div>

@endsection

@section ('footer')

    @include ('layouts.footer')

@endsection