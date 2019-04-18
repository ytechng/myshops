@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Product')

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
                        <h4 class="page-title">Products</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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

                            <form class="form-horizontal" action="{{ url('/admin/products/add') }}" method="post" id="frmCategory" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Product</h4>
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Product Category</label>
                                        <div class="col-sm-5">
                                            <select name="category_id" class="form-control" id="category_id">
                                                <?php echo $categoriesDropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_name" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="e.g Toyota">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_color" class="col-sm-3 text-right control-label col-form-label">Product Color</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="product_color" class="form-control" id="product_color" placeholder="e.g Gold">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_code" class="col-sm-3 text-right control-label col-form-label">Product Code</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="product_code" class="form-control" id="product_code" placeholder="e.g PRD">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-5">
                                            <textarea name="description" class="form-control" id="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_price" class="col-sm-3 text-right control-label col-form-label">Product Price</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="product_price" class="form-control" id="product_price" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_image" class="col-sm-3 text-right control-label col-form-label">Product Image</label>
                                        <div class="col-sm-5">
                                            <input type="file" name="product_image" class="form-control" id="product_image" placeholder="Image url here">
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
                                                <button type="submit" class="btn btn-success">Add Product</button>
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
                    product_name: {
                        required: true,
                        minlength: 2,
                    },

                    product_code: {
                        required: true,
                    },

                    product_price: {
                        required: true,
                        number: true,
                    },

                    product_image: {
                        required: true,
                        extension: 'jpg|jpeg|png',
                    },

                    category_id: {
                        required: true,
                    }

                },

                messages: {
                    product_name: 'Please enter the product name.',
                    product_code: 'Please enter the product code.',

                    product_price: {
                        required: 'Please enter the product price.',
                        number: 'Please enter a valid number.',
                    },

                    product_image: {
                        required: 'Please upload the product image.',
                        extension: 'Please upload a valid image file.',
                    },

                    category_id: 'Please select the product category.',
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