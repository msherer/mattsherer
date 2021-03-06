@extends ('layouts.admin')

@section('title', '| Invoices')

@section ('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                INVOICES
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{ URL::to('admin/invoice/create') }}">Create Invoice</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Invoice No.</th>
                                        <th>Company Name</th>
                                        <th>Company Email</th>
                                        <th>Discount</th>
                                        <th>Subtotal</th>
                                        <th>Grand Total</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Invoice No.</th>
                                        <th>Company Name</th>
                                        <th>Company Email</th>
                                        <th>Discount</th>
                                        <th>Subtotal</th>
                                        <th>Grand Total</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach ($invoices as $invoice)

                                        <tr>
                                            <td><a href="/invoice/{{ $invoice->id }}">{{ $invoice->id }}</a></td>
                                            <td>{{ $invoice->company_name }}</td>
                                            <td>{{ $invoice->company_email }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->subtotal }}</td>
                                            <td>{{ $invoice->grand_total }}</td>
                                            <td>{{ $invoice->created_at }}</td>
                                            <td>{{ $invoice->updated_at }}</td>
                                            <td><a href="/admin/invoice/{{ $invoice->id }}">View</a></td>
                                            <td><a href="{{ URL::to('admin/invoice/' . $invoice->id . '/edit') }}">Edit</a></td>
                                            <td>
                                                <form method="POST" action="/admin/invoice/{{ $invoice->id }}">

                                                    {{ method_field('DELETE') }}

                                                    {{ csrf_field() }}

                                                    <button type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

@endsection

@section ('scripts')

    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('js/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

@endsection