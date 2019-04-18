@extends('layouts.adminLayout.admin_design')
@section('title', 'Products')

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
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product List</li>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <a href="{{ url('/admin/category/add') }}" class="btn btn-success">Add New Category</a>
                                    <a href="{{ url('/admin/products/add') }}" class="btn btn-info">Add New Product</a>
                                </div>

                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                           <tr>
                                                <th>No</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Merchant</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                                <tr id="{{ $product->id }}">
                                                    <td></td>
                                                    <td>{{ $product->category_name }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->product_price }}</td>
                                                    <td><img src="/images/backend_img/products/small/{{ $product->product_image }}" style="width: 70px" /></td>
                                                    <td>{{ $product->merchant_name }}</td>
                                                    <td data-target="status">{{ $product->status === 1 ? 'Enabled' : 'Disabled'  }}</td>
                                                    <td>
                                                        <a href="{{ url('/admin/products/add-attributes/' . base64_encode($product->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" data-toggle="tooltip" title="Add attribute to {{ $product->product_name }}"></i></a> 

                                                        <a href="{{ url('/admin/products/add-images/' . base64_encode($product->id)) }}" class="btn btn-success btn-sm"><i class="fa fa-image" data-toggle="tooltip" title="Add Image to {{ $product->product_name }}"></i></a> 

                                                        <a href="#productModal{{ $product->id }}" class="btn btn-info btn-sm" data-toggle="modal"><i class="fa fa-eye" data-toggle="tooltip" title="View {{ $product->product_name }}"></i></a> 

                                                        <a href="{{ url('/admin/products/edit/' . base64_encode($product->id)) }}" class="btn btn-primary btn-sm fa fa-edit" title="Edit {{ $product->product_name }}"></a> 

                                                        <a class="btn btn-danger btn-sm deleteRecord" rel="{{ $product->id }}" data-role="delete" 
                                                            rel1="{{ $product->status }}" href="javascripts:">
                                                            <i class="fa fa-eye-slash" data-toggle="tooltip" title="Enable or Disable {{ $product->name }}"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                <!-- View Modal HTML -->
                                                @include('admin.products.modals.productModalView')

                                                <!-- Delete Modal HTML -->
                                                @include('admin.products.modals.productModalDelete')

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Owner</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
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

@section('page_script')
    <!-- this page js -->
    <script src="/js/backend_js/datatable-checkbox-init.js"></script>
    <script src="/js/backend_js/jquery.multicheck.js"></script>
    <script src="/js/backend_js/datatables.min.js"></script>
    <script src="/js/backend_js/jquery.modal.min.js"></script>
    <script src="/js/shared_js/sweetalert.min.js"></script>
    <script>
        
        $(document).ready(function() {
            
            $(document).on('click', 'a[data-role=delete]', function() {
                var pid = $(this).attr('rel');
                var status = $(this).attr('rel1');
                var title = (status == '1') ? 'DISABLE' : 'ENABLE';
                //alert('status >>>>>>>> ' +id);return false;
                
                swal({
                    title: title + " CATEGORY",
                    text: "Are you sure you want to "+ title +" this Category?",
                    icon: "warning",
                    closeModal: false,
                    dangerMode: true,
                    buttons: ['CANCEL', 'YES, ' + title + ' IT!'],
                    closeOnClickOutside: false,
                })

                .then((isDelete) => {
                    if (isDelete) {
                        $.ajax({
                            url:    '/admin/products/delete/' + pid,
                            method:   'get',
                            success: function(data) { 
                                
                                status = (status == '1') ? 'Disabled' : 'Enabled';
                                $('#' + pid).children('td[data-target=status]').text(status);

                                swal(data, {icon: "success"});
                                //console.log(data);
                            },
                            error: function(data) {
                                swal(data, {icon: "error"});
                                //console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
                            }
                        });

                    } else {
                        //swal("Cannot delete file!");
                    }
                });
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
        } ).draw();

    </script>
@endsection