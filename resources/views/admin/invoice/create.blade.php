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

                            <form method="POST" action="/admin/invoice">

                                {{ csrf_field() }}

                                <div class="row clearfix">
                                    <div class="panel no-margin">
                                        <div class="panel-heading">
                                            <div class="col-md-6">
                                                <h4 class="panel-title">Invoice <span class="text-danger">- 00975</span></h4>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <i class="custom-text">Date - <small class="text-success">20:08:2014</small></i>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-sx-12">
                                                    <div class="img-responsive pull-left">
                                                        <img src="{{ asset('images/profile_picture.jpeg') }}" width="48" height="48" alt="mattsherer" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-sx-12">
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-print"></i> <span class="hidden-xs">Print</span></button>
                                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <span class="hidden-xs">Save</span></button>
                                                        <button type="button" class="btn btn-danger"><i class="fa fa-envelope-o"></i> <span class="hidden-xs">Email</span></button>
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
                                                                        <input type="text" class="form-control" id="company_company" name="company_name" placeholder="Company Name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="company_phone" name="company_phone" placeholder="Company Phone" required>
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
                                                    <tr class="child">
                                                        <td>001</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="item" name="item" placeholder="Item" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="hours" name="hours" placeholder="Hours" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="total" name="total" placeholder="Total" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td class="total">Discount</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="discount" name="discount" placeholder="0%" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td class="total">Subtotal</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="$0" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td><h5>Grand Total</h5></td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" id="grand_total" name="grand_total" placeholder="$0" required>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" id="add-row" class="btn btn-info"><i class="fa fa-print"></i> <span class="hidden-xs">Add Row</span></button>
                                                <button type="button" id="remove-row" class="btn btn-info"><i class="fa fa-print"></i> <span class="hidden-xs">Remove Row</span></button>
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
            $("#add-row").click(function() {
                $("#invoice-table tbody tr.child").after('<tr><td colspan="3">test</td></tr>');
            });
        });
    </script>
@endsection