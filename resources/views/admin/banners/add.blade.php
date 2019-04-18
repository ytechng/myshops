@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Banner')

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
                        <h4 class="page-title">Add Banner</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Banner</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
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

                            <form class="form-horizontal" action="{{ url('/admin/banners/add') }}" method="post" id="frmCoupon" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Banner</h4>

                                    <div class="form-group row">
                                        <label for="image" class="col-sm-3 text-right control-label col-form-label">Banner Image</label>
                                        <div class="col-sm-5">
                                            <input type="file" name="image" class="form-control" id="image" placeholder="Image url here">
                                        </div>
                                    </div>                                    
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-3 text-right control-label col-form-label">Title</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Banner title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-5">
                                            <textarea name="description" class="form-control" id="description"></textarea>
                                        </div>
                                    </div>                                  
                                    <div class="form-group row">
                                        <label for="link" class="col-sm-3 text-right control-label col-form-label">Link</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="link" class="form-control" id="link" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="linkto" class="col-sm-3 text-right control-label col-form-label">Link To Website</label>
                                        <div class="col-sm-3">
                                            <input type="radio" name="linkto" class="text-left" value="0" checked/> NO &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="linkto" class="text-left" value="1"/> YES
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                            <div class="col-sm-3">
                                                <input type="radio" name="status" class="text-left" value="1" checked/> Active  &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="status" class="text-left" value="0"/> Not Active
                                            </div>
                                        </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-success">Add Banner</button>
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
                title: {
                    required: true,
                    // minlength: 5,
                },

                image: {
                    required: true,
                    extension: 'jpg|jpeg|png',
                },
            },

            messages: {
                title: {
                    required: 'Please enter banner title.',
                    // minlength: 'Banner title must be 5 characters or more.',
                },
                image: {
                    required: 'Please upload an image for this banner.',
                    extension: 'Please upload a valid image file.',
                },
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