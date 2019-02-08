@extends ('layouts.admin')

@section('title', '| Edit Post')

@section ('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT POST</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/posts/{{ $post->id }}">

                                {{ method_field('PUT') }}

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $post->title }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="image" name="image" placeholder="Image URL" value="{{ $post->image }}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <p>Short Description</p>
                                    <textarea id="short_description" name="short_description" required>{!! $post->short_description !!}</textarea>
                                </div>


                                <div class="form-group">
                                    <p>Long Description</p>
                                    <textarea id="description" name="description" required>{!! $post->description !!}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section ('scripts')

    <!-- Ckeditor -->
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>

    <!-- TinyMCE -->
    <script src="{{ asset('js/plugins/tinymce/tinymce.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/pages/forms/editors.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/pages/forms/editors.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>

@endsection