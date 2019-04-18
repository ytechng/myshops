@extends('layouts.adminLayout.admin_design')
@section('title', 'Banners')

@section('styles')
    <link href="/css/backend_css/dataTables.bootstrap4.css" rel="stylesheet">
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
                        <h4 class="page-title">Banners</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Banners</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Banners</li>
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
                        <a href="/admin/banners/"> View banners here!</a>
                    </div>
                @endif

                @if (Session::has('success_msg'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('success_msg') }}</strong> 
                        <a href="/admin/banners/"> View banners here!</a>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <a href="{{ url('/admin/banners/add') }}" class="btn btn-success">Add New Banner</a>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                           <tr>
                                                <th>No</th>
                                                <th>Image</th> 
                                                <th>Title</th>                                                                                               
                                                <th>Link</th>
                                                <th>Link To Website</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($banners) > 0) {?>
                                            @foreach ($banners as $banner)
                                                <tr id="row{{ $banner->id }}">
                                                    <td data-target="sn"></td>
                                                    <td data-target="image"><img src="/images/frontend_img/banners/{{ $banner->image }}" style="width: 140px" /></td>
                                                    <td data-target="title">{{ $banner->title }}</td>
                                                    <td data-target="link">{{ $banner->link }}</td>
                                                    <td data-target="linkto">{{ $banner->link_to_website == 1 ? 'YES' : 'NO' }}</td>
                                                    <td data-target="status">{{ $banner->status == 1 ? 'Active' : 'Disabled'  }}</td>
                                                    <td>
                                                        <input type="hidden" id="desc-row{{ $banner->id }}" />
                                                        <a href="#" data-id="{{ $banner->id }}" rel="{{ $banner->description }}" data-role="edit" class="btn btn-primary btn-sm fa fa-edit"
                                                            title="Edit {{ $banner->title }}" data-toggle="tooltip"></a> 

                                                        <a class="btn btn-danger btn-sm" rel="{{ $banner->id }}" data-role="delete" 
                                                            rel1="{{ $banner->status }}" href="javascripts:">
                                                            <i class="fa fa-eye-slash" data-toggle="tooltip" title="Enable or Disable {{ $banner->title }}"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach 
                                            
                                            <?php } else {?>

                                                <tr>
                                                    <td colspan="6" class="text-danger">
                                                        <strong>There is no record found!</strong>
                                                    </td>
                                                </tr>
        
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th> 
                                                <th>Title</th>                                                                                               
                                                <th>Link</th>
                                                <th>Link To Website</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Edit Coupon Modal-->
                                @include('admin.banners.modal.edit_banner_modal')
                                
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
    <script src="/js/backend_js/datatables.min.js"></script>
    <script src="/js/shared_js/sweetalert.min.js"></script>
    <script src="/js/backend_js/jquery.validate.min.js"></script>
    <script src="/js/backend_js/jquery-ui.min.js"></script>
    <script>

        function alerMessage(title, objectName) {
            swal({
                title: title + " " + objectName,
                text: "Are you sure you want to "+ title +" this coupon?",
                icon: "warning",
                closeModal: false,
                dangerMode: true,
                buttons: ['CANCEL', 'YES, ' + title + ' IT!'],
                closeOnClickOutside: false,
            })
        }

        $(document).ready(function() {

            // hide message div on modal
            $('#msgDiv').hide();

            /** Update coupon **/
            $(document).on('click', 'a[data-role=edit]', function() {
                var id = $(this).data('id');       
                var desc = $(this).attr('rel');

                var image = $('#row' + id).children('td[data-target=image]').text();
                var title = $('#row' + id).children('td[data-target=title]').text();
                var link = $('#row' + id).children('td[data-target=link]').text();
                var linkto = $('#row' + id).children('td[data-target=linkto]').text();

                // Load edit modal with selected data from coupons table
                $('#e_id').val(id);
                $('#e_image').val(image);
                $('#e_title').val(title);
                $('#e_desc').val(desc);
                $('#e_link').val(link);

                if (linkto == 'YES') {
                    $('#e_yes').attr('checked', true);
                    $('#e_no').attr('checked', false);
                } else {
                    $('#e_yes').attr('checked', false);
                    $('#e_no').attr('checked', true);
                }
                
                $('#editBannerModal').modal('toggle');
            });

            /** Delete coupon **/
            $(document).on('click', 'a[data-role=delete]', function() {
                var id = $(this).attr('rel');
                var status = $(this).attr('rel1');
                var title = (status == '1') ? 'DISABLE' : 'ENABLE';
                //alert('status >>>>>>>> ' +id);return false;
                
                swal({
                    title: title + " BANNER",
                    text: "Are you sure you want to "+ title +" this banner?",
                    icon: "warning",
                    closeModal: false,
                    dangerMode: true,
                    buttons: ['CANCEL', 'YES, ' + title + ' IT!'],
                    closeOnClickOutside: false,
                })

                .then((isDelete) => {
                    if (isDelete) {
                        $.ajax({
                            url:    '/admin/banners/delete/' + id,
                            method:   'get',
                            success: function(data) {                                 
                                status = (status == '1') ? 'Disabled' : 'Active';
                                $('#row' + id).children('td[data-target=status]').text(status);

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
        }).draw();

    </script>
@endsection