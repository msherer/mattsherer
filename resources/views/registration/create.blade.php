@extends ('layouts.default')

@section ('header')

    @include ('layouts.header')

@endsection

@section ('content')

    {{ $flash = session('message') }}
    @if ($flash)
        <div id="flash-message" class="alert alert-success" role="alert">
            {{ $flash }}
        </div>
    @endif

    <div class="kotha-default-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <article class="single-blog">
                        <div class="post-thumb">
                            <img src="{{ URL::asset('images/post-thumb-1.jpg') }}" alt="">
                        </div>
                        <div class="post-content">
                            <div class="entry-header text-center text-uppercase">
                                <a href="" class="post-cat">Travel</a>
                                <h2>Register</h2>
                            </div>
                            <div class="entry-content">

                                @include ('layouts.errors')

                                <form method="POST" action="/register">

                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Password Confirmation:</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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