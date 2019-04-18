@extends('layouts.adminLayout.admin_design')
@section('title', 'Categories')

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
                        <h4 class="page-title">Categories</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
                                    <a href="{{ url('/admin/categories/add') }}" class="btn btn-success">New Category</a>
                                    <a href="{{ url('/admin/products/add') }}" class="btn btn-info">Add Product</a>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                           <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Parent ID</th>
                                                <th>Description</th>
                                                <th>Url</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                                <tr id="{{ $category->id }}">
                                                    <td></td>
                                                    <td data-target="name">{{ $category->name }}</td>
                                                    <td data-target="pid">{{ $category->parent_id }}</td>
                                                    <td data-target="desc">{{ $category->description }}</td>
                                                    <td data-target="url">{{ $category->url }}</td>
                                                    <td data-target="status">{{ $category->status == 1 ? 'Enabled' : 'Disabled'  }}</td>
                                                    <td>
                                                        <a href="#categoryModal{{ $category->id }}" class="btn btn-success btn-sm" data-toggle="modal">
                                                            <i class="fa fa-eye" data-toggle="tooltip" title="View {{ $category->name }}"></i></a> 

                                                        <a href="#" data-id="{{ $category->id }}" data-role="update" class="btn btn-primary btn-sm fa fa-edit"
                                                                title="Edit {{ $category->name }}" data-toggle="tooltip"></a> 

                                                                
                                                        <a class="btn btn-danger btn-sm" rel="{{ $category->id }}" data-role="delete" 
                                                            rel1="{{ $category->status }}" href="javascripts:">
                                                            <i class="fa fa-eye-slash" data-toggle="tooltip" title="Enable or Disable {{ $category->name }}"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Edit Coupon Modal-->
                                                @include('admin.categories.modals.edit_category_modal')

                                                <!-- Delete Modal HTML -->
                                                @include('admin.categories.modals.categoryModalDelete')

                                                <!-- View Modal HTML -->
                                                @include('admin.categories.modals.categoryModalView')

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Parent ID</th>
                                                <th>Description</th>
                                                <th>Url</th>
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
    <script src="/js/shared_js/sweetalert.min.js"></script>
    <script>

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

       // $(document).on('click', '.deleteRecord', function() {
       //      var pid = $(this).attr('rel');
       //      alert('Product ID = ' + pid);
       //      return false;
       // });

       $(document).ready(function() {

           /** Update category **/
           $(document).on('click', 'a[data-role=update]', function() {
                var id = $(this).data('id');      
                //alert('ID >>>>>>>>>>>>>>>>>>>> ' +id);          
                var name = $('#' + id).children('td[data-target=name]').text();
                var pid = $('#' + id).children('td[data-target=pid]').text();
                var desc = $('#' + id).children('td[data-target=desc]').text();
                var url = $('#' + id).children('td[data-target=url]').text();
                var status = $('#' + id).children('td[data-target=status]').text();

                // Load edit modal with selected data from category table
                $('#e_id').val(id);
                $('#e_pid').val(pid);
                $('#e_name').val(name);
                $('#e_desc').val(desc);
                $('#e_url').val(url);

                $('#editCategoryModal').modal('toggle');
            });


            // Now create event to get data from fields and update the database
            $('#update').click(function() {

                var id = $('#e_id').val();
                var pid = $('#e_pid').val();
                var name = $('#e_name').val();
                var desc = $('#e_desc').val();
                var url = $('#e_url').val();

                $.ajax({
                    url:    '/admin/categories/edit/' + id + '/' + pid + '/' + name + '/' + desc + '/' + url,
                    method:   'get',
                    success: function(data) { 
                        //alert('SUCCESS' +data);

                        $('#' + id).children('td[data-target=pid]').text(pid);
                        $('#' + id).children('td[data-target=name]').text(name);
                        $('#' + id).children('td[data-target=desc]').text(desc);
                        $('#' + id).children('td[data-target=url]').text(url);

                        swal(data, {icon: "success"});

                        $('#editCategoryModal').modal('hide');
                        console.log(data);
                    },
                    error: function(data) {
                        swal(data, {icon: "error"});
                        console.log(console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data));
                    }
                });
            });

            // enable or disable category
            $(document).on('click', 'a[data-role=delete]', function() {
                var id = $(this).attr('rel');
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
                            url:    '/admin/categories/delete/' + id,
                            method:   'get',
                            success: function(data) { 
                                
                                status = (status == '1') ? 'Disabled' : 'Enabled';
                                $('#' + id).children('td[data-target=status]').text(status);

                                swal(data, {icon: "success"});
                                console.log(data);
                            },
                            error: function(data) {
                                swal(data, {icon: "error"});
                                console.log(console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data));
                            }
                        });

                    } else {
                        //swal("Cannot delete file!");
                    }
                });
           });
       });

    </script>
@endsection