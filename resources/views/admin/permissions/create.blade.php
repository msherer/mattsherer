@extends ('layouts.admin')

@section('title', '| Create Permission')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT PERMISSION</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/permissions">

                                {{ method_field('PUT') }}

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="name">Permission Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>

                                @if(!$roles->isEmpty())
                                    <h4>Assign Permission to Roles</h4>

                                    @foreach ($roles as $role)

                                        <div class="form-group">
                                            <input id="{{ $role->name }}" type="checkbox" name="roles[]">
                                            <label for="{{ $role->name }}">{{ ucfirst($role->name) }}</label>
                                        </div>

                                    @endforeach

                                @endif

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