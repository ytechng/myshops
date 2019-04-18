@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Product Images')

@section('styles')
    <link rel="stylesheet" href="/css/backend_css/multicheck.css">
    <link href="/css/backend_css/dataTables.bootstrap4.css" rel="stylesheet">
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
                        <h4 class="page-title">Products</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Product Images</li>
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

                            <form class="form-horizontal" action="{{ url('/admin/products/add-images/'. base64_encode($product->id)) }}" method="post" id="frmAddImage" name="add_Image" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Add Product Images</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                        <div class="col-sm-9">
                                            <label class="col-sm-3 control-label col-form-label">
                                                <strong>{{ $product->product_name }}</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Product Code</label>
                                        <div class="col-sm-9">
                                            <label class="col-sm-3 control-label col-form-label">
                                                <strong>{{ $product->product_code }}</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="field_wrapper">
                                        <div class="form-group row">
                                            <label for="product_image" class="col-sm-3 text-right control-label col-form-label">Alternate Image(s)</label>
                                            <div class="col-sm-6">
                                                <input type="file" name="product_image[]" class="col-sm-10" id="product_image" multiple="multiple" placeholder="Image url here">
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><span class="fa fa-plus-circle"> </span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 text-right">
                                                <button type="submit" class="btn btn-success">Add Images</button>
                                            </div>
                                            <div class="col-lg-6 text-left">
                                                <a href="javascript:history.go(-1)" class="btn btn-danger">Previous Page</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                           <tr>
                                                <th>S/NO</th>
                                                <th>PRODUCT ID</th>
                                                <th>IMAGE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product['images'] as $image)

                                                <tr>
                                                    <td></td>                                                    
													<td>{{ $image->product_id }}</td>
                                                    <td><img src="/images/backend_img/products/small/{{ $image->product_image }}" style="width: 70px" /></td>                  
                                                    <td>{{ $image->status == 1 ? 'Enable' : 'Disable' }}</td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm deleteImage" rel="{{ base64_encode($image->id) }}" rel1="delete-image" rel2="{{ $image->status }}" href="javascripts:"><i class="fa fa-eye-slash" data-toggle="tooltip" title="Delete {{ $image->product_image }}"></i></a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S/NO</th>
                                                <th>PRODUCT ID</th>
                                                <th>IMAGE</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>
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
    <script src="/js/backend_js/datatables.min.js"></script>
    <script src="/js/backend_js/jquery.modal.min.js"></script>
    <script src="/js/shared_js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {

            /** end #frmSetting validation **/
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><div class="form-group row"><label for="product_image" class="col-sm-3 text-right control-label col-form-label"></label><div class="col-sm-6"><input type="file" name="product_image[]" class="col-sm-10" id="product_image" multiple="multiple" placeholder="Image url here"><a href="javascript:void(0);" class="remove_button" title="Remove field"> <span class="fa fa-minus-circle text-danger"> </span></a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).closest('div.form-group').remove(); //Remove field html
                x--; //Decrement field counter
            });


            // Delete product attribute
            $(".deleteImage").click(function() {
                var id = $(this).attr('rel');
                var status = $(this).attr('rel2');

                swal({
                    title: " DELETE PRODUCT IMAGE",
                    text: "Are you sure you want to DELETE this Image?",
                    icon: "warning",
                    closeModal: false,
                    dangerMode: true,
                    buttons: ['CANCEL', 'YES, DELETE IT!'],
                    closeOnClickOutside: false,
                })

                .then((isDelete) => {
                    if (isDelete) {
                        fetch("/admin/products/delete/alternate-image/" + id);
                        swal("Product image was deleted successfully!", {icon: "success"});
                        window.location.reload(true);
                    } else {
                        //swal("Cannot delete file!");
                    }
                });
           });


            /****************************************
             *       Basic Table                   *
             ****************************************/
            var t = $('#zero_config').DataTable();

            // this will add autoincrement id to the datatable
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            }).draw();
        });
    </script>
@endsection