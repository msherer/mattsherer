@extends ('layouts.admin')

@section('title', '| View Invoice')

@section ('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VIEW NES LIST</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="panel no-margin">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="invoice-table" class="table table-striped table-bordered table-hover no-margin">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>Cart</td>
                                                    <td>Instructions</td>
                                                    <td>Box</td>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($mNames as $mName)
                                                    <tr>
                                                        <td>
                                                            {{ $mName['name'] }}
                                                        </td>
                                                        <td class="{{ $mName['hasAttribute']['cart'] === true ? 'bg-pink' : '' }}">
                                                            {{ $mName['cart'] }}
                                                        </td>
                                                        <td class="{{ $mName['hasAttribute']['instructions'] === true ? 'bg-pink' : '' }}">
                                                            {{ $mName['instructions'] }}
                                                        </td>
                                                        <td class="{{ $mName['hasAttribute']['box'] === true ? 'bg-pink' : '' }}">
                                                            {{ $mName['box'] }}
                                                        </td>
                                                        <td>
                                                            {{ $mName['price'] }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4"><h5>List Count</h5></td>
                                                    <td>
                                                        {{ $listCount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><h5>Grand Total</h5></td>
                                                    <td>
                                                        {{ $grandTotal }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script type="text/javascript">
        $('#file_download').on('click', function() {
            $.get('/admin/invoice/test', function(response) {
                console.log(response);
            });
        });
    </script>
@endsection