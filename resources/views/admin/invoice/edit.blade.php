@extends ('layouts.admin')

@section('title', '| Create Invoice')

@section ('content')
    <style>
        .form-group {
            margin-bottom: 5px;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE INVOICE</h2>
                        </div>
                        @include ('layouts.errors')
                        <div class="body">

                            <form method="POST" action="/admin/invoice/{{ $invoice->id }}">

                                {{ method_field('PUT') }}

                                {{ csrf_field() }}

                                <div class="row clearfix">
                                    <div class="panel no-margin">
                                        <div class="panel-heading">
                                            <div class="col-md-6">
                                                <h4 class="panel-title">Invoice <span class="text-danger">- {{ $invoice->id }}</span></h4>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <i class="custom-text">Date - <small class="text-success">{{ $invoice->created_at }}</small></i>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-sx-12">
                                                    <div class="img-responsive">
                                                        <img src="{{ asset('images/profile_picture.jpeg') }}" width="48" height="48" alt="mattsherer" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-sx-12">
                                                    <div class="pull-right">
                                                        <button type="button" id="file_download" alt="Download Invoice" class="btn bg-light-green waves-effect">
                                                            <i class="material-icons">file_download</i>
                                                        </button>
                                                        <button type="submit" class="btn bg-light-green waves-effect">
                                                            <i class="material-icons">save</i>
                                                        </button>
                                                        <button type="button" id="file_email" alt="Email Invoice" class="btn bg-light-green waves-effect">
                                                            <i class="material-icons">email</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width:50%">
                                                            <address class="no-margin">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_company" name="company_name" placeholder="Company Name" value="{{ $invoice->company_name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" value="{{ $invoice->company_address }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="{{ $invoice->company_email }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Company Phone" value="{{ $invoice->company_phone }}" required>
                                                                    </div>
                                                                </div>
                                                            </address>
                                                        </td>
                                                        <td style="width:50%" class="text-right">
                                                            <address class="no-margin">
                                                                <h4><strong>Revision Technology, Corp.</strong></h4>
                                                                <strong>Your Address</strong> <br>
                                                                <abbr title="email">E-mail:</abbr>
                                                                <a href="mailto:#" data-original-title="" title="">msherer033@gmail.com</a><br>
                                                                <abbr title="Phone">Phone:</abbr> (414) 216-4157
                                                            </address>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="invoice-table" class="table table-striped table-bordered table-hover no-margin">
                                                    <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>No.</th>
                                                        <th>Item</th>
                                                        <th>Hours</th>
                                                        <th>Rate</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($invoiceItems as $invoiceKey => $invoiceItem)
                                                        <tr class="child{{ $invoiceKey }}">
                                                            <td><button type="button" class="remove-row btn bg-deep-orange waves-effect">x</button></td>
                                                            <td>
                                                                00{{ $invoiceItem->id }}
                                                                <input type="hidden" id="invoice_item_id" name="invoice_item[{{ $invoiceKey }}][id]" value="{{ $invoiceItem->id }}">
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="item" name="invoice_item[{{ $invoiceKey }}][item]" placeholder="Item" value="{{ $invoiceItem->item }}" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="hours" name="invoice_item[{{ $invoiceKey }}][hours]" placeholder="Hours" value="{{ $invoiceItem->hours }}" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="rate" name="invoice_item[{{ $invoiceKey }}][rate]" placeholder="Rate" value="{{ $invoiceItem->rate }}" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="total" name="invoice_item[{{ $invoiceKey }}][total]" placeholder="Total" value="{{ $invoiceItem->total }}" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="total">Discount</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="discount" name="discount" placeholder="0%" value="{{ $invoice->discount }}" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td class="total">Subtotal</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="$0" value="{{ $invoice->subtotal }}" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                        <td><h5>Grand Total</h5></td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="grand_total" name="grand_total" placeholder="$0" value="{{ $invoice->grand_total }}" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" id="add-row" class="btn bg-light-blue waves-effect">Add Row</button>
                                            </div>
                                        </div>
                                    </div>
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

    <script type="text/javascript">
        $(function() {
            var row = 0;
            var rowLabel = 1;
            $("#add-row").click(function() {
                var childRow = '#invoice-table tbody tr.child' + row;
                ++row;
                ++rowLabel;
                $(childRow).after('    <tr class="child' + row + '">\n' +
                    '        <td><button type="button" class="remove-row btn bg-deep-orange waves-effect">x</button></td>\n' +
                    '        <td>00' + rowLabel +'</td>\n' +
                    '        <td>\n' +
                    '            <div class="form-group">\n' +
                    '                <div class="form-line">\n' +
                    '                    <input type="text" class="form-control" id="item" name="invoice_item[' + row + '][item]" placeholder="Item" required>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </td>\n' +
                    '        <td>\n' +
                    '            <div class="form-group">\n' +
                    '                <div class="form-line">\n' +
                    '                    <input type="text" class="form-control" id="hours" name="invoice_item[' + row + '][hours]" placeholder="Hours" required>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </td>\n' +
                    '        <td>\n' +
                    '            <div class="form-group">\n' +
                    '                <div class="form-line">\n' +
                    '                    <input type="text" class="form-control" id="rate" name="invoice_item[' + row + '][rate]" placeholder="Rate" required>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </td>\n' +
                    '        <td>\n' +
                    '            <div class="form-group">\n' +
                    '                <div class="form-line">\n' +
                    '                    <input type="text" class="form-control" id="total" name="invoice_item[' + row + '][total]" placeholder="Total" required>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '        </td>\n' +
                    '    </tr>');
            });

            $('#invoice-table').on('click', '.remove-row', function() {
                if (row > 0) {
                    $(this).closest('tr').remove();
//                    $('child' + row).remove();
                    row--;
                    rowLabel--;
                }
            });

            $('#file_download').on('click', function() {
                $.get('/admin/invoice/test', function(response) {
                    console.log(response);
                });
            });
        });
    </script>
@endsection