@extends ('layouts.admin')

@section('title', '| View Invoice')

@section ('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VIEW INVOICE</h2>
                        </div>
                        <div class="body">
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
                                                                    {{ $invoice->company_name }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    {{ $invoice->company_address }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    {{ $invoice->company_email }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    {{ $invoice->company_phone }}
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
                                                        <td>
                                                            00{{ $invoiceItem->id }}
                                                        </td>
                                                        <td>
                                                            {{ $invoiceItem->item }}
                                                        </td>
                                                        <td>
                                                            {{ $invoiceItem->hours }}
                                                        </td>
                                                        <td>
                                                            {{ $invoiceItem->rate }}
                                                        </td>
                                                        <td>
                                                            {{ $invoiceItem->total }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="total">Discount</td>
                                                    <td>
                                                        {{ $invoice->discount }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td class="total">Subtotal</td>
                                                    <td>
                                                        {{ $invoice->subtotal }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td><h5>Grand Total</h5></td>
                                                    <td>
                                                        {{ $invoice->grand_total }}
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