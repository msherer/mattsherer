@extends ('layouts.default')

@section ('header')

    @include ('layouts.header')

@endsection

@section ('content')

    <div class="kotha-default-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <article class="single-blog contact-us">
                        <div class="post-thumb">
                            <img src="{{ URL::asset('images/archi-feature-cat-6.jpg') }}" alt="">
                        </div>
                        <div class="post-content">
                            <div class="entry-header text-center text-uppercase">

                                <h2 class="text-left">contact us</h2>
                            </div>
                            <div class="entry-content">
                                <p>Need some help? Shoot me an email, I try to respond to all my emails within a day at the latest.</p>
                            </div>

                            <div class="leave-comment">

                                @include ('layouts.errors')

                                <h4>SEND MASSAGE</h4>
                                <form class="form-horizontal contact-form" method="POST" action="/contact">

                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="6" name="message" placeholder="Write Massage"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn send-btn"> SEND MASSAGE</button>
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