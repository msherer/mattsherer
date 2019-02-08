@extends ('layouts.admin')

@section('title', '| Edit Role')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT ROLE</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/roles/{{ $role->id }}">

                                {{ method_field('PUT') }}

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h4>Assign Permissions</h4>

                                    @foreach ($permissions as $permission)

                                        <div class="form-group">
                                            <input id="{{ $permission->name }}" type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (in_array($permission->id, $rolePermissions) ? 'checked' : '') }}>
                                            <label for="{{ $permission->name }}">{{ ucfirst($permission->name) }}</label>
                                        </div>

                                    @endforeach

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