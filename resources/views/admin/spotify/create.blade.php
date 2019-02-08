@extends ('layouts.admin')

@section('title', '| Create Spotify Widget')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT WIDGET</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/spotify">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="name">Widget Name</label>
                                        <input class="form-control" id="name" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="client_id">Client ID</label>
                                        <input class="form-control" id="client_id" name="client_id" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="client_secret_id">Client Secret ID</label>
                                        <input type="password" class="form-control" id="client_secret_id" name="client_secret_id" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="redirect_uri">Redirect Uri</label>
                                        <input class="form-control" id="redirect_uri" name="redirect_uri" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection