@extends ('layouts.admin')

@section('title', '| Add User')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE USER</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/users">

                                {{ method_field('PUT') }}

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                @foreach ($roles as $role)

                                    <div class="form-group">
                                        <input id="{{ $role->name }}" type="checkbox" name="roles[]" value="{{ $role->id }}">
                                        <label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label>
                                    </div>

                                @endforeach


                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="password_confirmation">Password Confirmation:</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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

@section ('scripts')

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>

@endsection