@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Coupon')

@section('styles')
    <link rel="stylesheet" href="/css/backend_css/jquery-ui.css">
@endsection

@section('body_content')
    <div id="main-wrapper">
        <!-- ====================Begin header file=========================== -->
        @include('layouts.adminLayout.admin_header')
        <!-- ====================End header file============================= -->

        <!-- ====================sidebar============================ -->
        @include('layouts.adminLayout.admin_sidebar')
        <!-- ========================End sidebar=========================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Add Coupon</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Coupon</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            @if (Session::has('error_msg'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('error_msg') }}</strong>
                                </div>
                            @endif

                            @if (Session::has('success_msg'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ session('success_msg') }}</strong>
                                </div>
                            @endif

                            <form class="form-horizontal" action="{{ url('/admin/coupons/add') }}" method="post" id="frmCoupon" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Coupon</h4>
                                    
                                    <div class="form-group row">
                                        <label for="coupon_code" class="col-sm-3 text-right control-label col-form-label">Coupon Code</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="coupon_code" class="form-control" id="coupon_code" placeholder="coupon code">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="amount" class="form-control" id="amount" min="0" placeholder="e.g 1000">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount_type" class="col-sm-3 text-right control-label col-form-label">Amount Type</label>
                                        <div class="col-sm-5">
                                            <select name="amount_type" class="form-control" id="product_code">
                                                <option value="1">Percentage</option>
                                                <option value="2">Flat Rate</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="start_date" class="form-control" id="start_date" placeholder="start date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="expiry_date" class="col-sm-3 text-right control-label col-form-label">Expiry Date</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="expiry_date" class="form-control" id="expiry_date" placeholder="expiry date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-1">
                                            <input type="radio" name="status" class="text-left" value="1" checked/> 
                                            <label>Enable</label>
                                            <p><input type="radio" name="status" class="text-left" value="0"/> 
                                            <label>Disable</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-success">Add Coupon</button>
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                <a href="javascript:history.go(-1)" class="btn btn-danger">Previous Page</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('layouts.adminLayout.admin_footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

@endsection

@section('page_script')    <!-- Form Validation -->
<script src="/js/backend_js/jquery.validate.min.js"></script>
<script src="/js/backend_js/additional-methods.js"></script>
<script src="/js/backend_js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        // datepicker
        $( "#start_date" ).datepicker({
            changeYear: true,
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selectDate) {
                var dt = new Date(selectDate);
                //dt.setDate(dt.getDate() + 1);
                dt.setDate(dt.getDate());

                $( "#expiry_date" ).datepicker("option", "minDate", dt);
            }
        });

        $( "#expiry_date" ).datepicker({
            changeYear: true,
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selectDate) {
                var dt = new Date(selectDate);
                //dt.setDate(dt.getDate() - 1);
                dt.setDate(dt.getDate());

                $( "#start_date" ).datepicker("option", "maxDate", dt);
            }
        });


        /** begin #frmSetting validation **/
        $('#frmCoupon').validate({
            rules: {
                coupon_code: {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                },

                amount: {
                    required: true,
                    number: true,
                },

                start_date: {
                    required: true,
                },

                expiry_date: {
                    required: true,
                }
            },

            messages: {
                coupon_code: {
                    required: 'Please enter the coupon code.',
                    minlength: 'Coupon code must be 5 characters or more.',
                    maxlength: 'Coupon code cannot be more than 15 characters.'
                },
                amount: {
                    required: 'Please enter the amount on coupon.',
                    number: 'Please enter a valid amount.'
                },

                start_date: {
                    required: 'Please enter the coupon start date.',

                },

                expiry_date: {
                    required: 'Please enter the coupon expiry date.',
                }
            },

            errorClass: "text-danger",
            errorElement: "label",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('text-danger');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('text-danger');
                $(element).parents('.control-group').addClass('text-danger');
            }
        });
        /** end #frmSetting validation **/
    });
</script>
@endsection