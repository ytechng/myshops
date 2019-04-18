@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Category')

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
                        <h4 class="page-title">Categories</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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

                            <form class="form-horizontal" action="{{ url('/admin/categories/add') }}" method="post" id="frmCategory" novalidate="novalidate">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Category</h4>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Category Name Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="parent_id" class="col-sm-3 text-right control-label col-form-label">Category subCat</label>
                                        <div class="col-sm-5">
                                            <select name="parent_id" class="form-control" id="parent_id">
                                                <option value="0">Main Category</option>
                                                @foreach($subCategory as $subCat)
                                                    <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-5">
                                            <textarea name="description" class="form-control" id="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="url" class="col-sm-3 text-right control-label col-form-label">URL</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="url" class="form-control" id="url" placeholder="e.g electronics">
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
                                                <button type="submit" class="btn btn-success">Add Category</button>
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
    <script>
        $(document).ready(function() {
            /** begin #frmSetting validation **/
            $('#frmCategory').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                    },

                    url: {
                        required: true,
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