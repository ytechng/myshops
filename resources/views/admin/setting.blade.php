@extends('layouts.adminLayout.admin_design')
@section('title', 'Admin Settings')

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
                        <h4 class="page-title">Settings</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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

                            <form class="form-horizontal" action="{{ url('/admin/update-password') }}" method="post" id="frmSetting" novalidate="novalidate">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Password Modification</h4>
                                    <div class="form-group row">
                                        <label for="cur_password" class="col-sm-3 text-right control-label col-form-label">Current Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="cur_password" class="form-control" id="cur_password" placeholder="Current Password Here">
                                            <span id="chkPwd"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-3 text-right control-label col-form-label">Comfirm Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password Here">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-danger">Update Password</button>
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
    <script>
        $(document).ready(function() {

            /** begin #cur_password validation **/
            $('#cur_password').blur(function() {
                var cur_password = $('#cur_password').val();

                $.ajax({
                    type: 'get',
                    url: '/admin/check-password',
                    data: {cur_password:cur_password},
                    success: function(resp) {
                        //alert(resp);
                        if (resp == "false") {
                            $('#chkPwd').html("<font color='#da542e'><b><em>Current Password is Incorrect!</em></b></font>");
                        } else {
                            $('#chkPwd').html("<font color='#618620'><b><em>Current Password is Correct!</em></b></font>");
                        }
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });
            /** end #cur_password validation **/

            /** begin #frmSetting validation **/
            $('#frmSetting').validate({
                rules: {
                    cur_password: {
                        required: true,
                    },

                    new_password: {
                        required: true,
                        minlength: 6,
                    },

                    confirm_password: {
                        required: true,
                        equalTo: '#new_password',
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