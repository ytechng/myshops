@extends('layouts.adminLayout.admin_design')
@section('title', 'Coupons')

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
                        <a href="/admin/coupons/"> View coupons here!</a>
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
                                    <a href="{{ url('/admin/coupons/add') }}" class="btn btn-success">New Coupon</a>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                           <tr>
                                                <th>No</th>
                                                <th>Coupon Code</th>
                                                <th>Amount</th>                                                
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>Expiry Date</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($coupons) > 0) {?>
                                            @foreach ($coupons as $coupon)
                                                <tr id="{{ $coupon->coupon_code }}">
                                                    <td data-target="sn"></td>
                                                    <td data-target="code">{{ $coupon->coupon_code }}</td>
                                                    <td data-target="amount">{{ $coupon->amount }}</td>
                                                    <td data-target="type">{{ $coupon->amount_type == 1 ? 'Percentage' : 'Fixed Rate' }}</td>
                                                    <td data-target="sdate">{{ $coupon->start_date }}</td>
                                                    <td data-target="edate">{{ $coupon->expiry_date }}</td>
                                                    <td data-target="status">{{ $coupon->status == 1 ? 'Enabled' : 'Disabled'  }}</td>
                                                    <td data-target="creator">{{ $coupon->merchant_name }}</td>
                                                    <td>
                                                        <a href="#" data-id="{{ $coupon->coupon_code }}" data-role="edit" class="btn btn-primary btn-sm fa fa-edit"
                                                            title="Edit {{ $coupon->coupon_code }}" data-toggle="tooltip"></a> 

                                                        <a class="btn btn-danger btn-sm" rel="{{ $coupon->coupon_code }}" data-role="delete" 
                                                            rel1="{{ $coupon->status }}" href="javascripts:">
                                                            <i class="fa fa-eye-slash" data-toggle="tooltip" title="Enable or Disable {{ $coupon->coupon_code}}"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach 
                                            
                                            <?php } else {?>

                                                <tr>
                                                    <td colspan="6" class="text-danger">
                                                        <strong>There is no attributes recorded for this product!</strong>
                                                    </td>
                                                </tr>
        
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Coupon Code</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>Expiry Date</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Edit Coupon Modal-->
                                @include('admin.coupons.modal.edit_coupon_modal')
                                
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

            // datepicker
            $( "#e_sdate" ).datepicker({
                changeYear: true,
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selectDate) {
                    var dt = new Date(selectDate);
                    //dt.setDate(dt.getDate() + 1);
                    dt.setDate(dt.getDate());

                    $( "#e_edate" ).datepicker("option", "minDate", dt);
                }
            });

            $( "#e_edate" ).datepicker({
                changeYear: true,
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd',
                onSelect: function(selectDate) {
                    var dt = new Date(selectDate);
                    //dt.setDate(dt.getDate() - 1);
                    dt.setDate(dt.getDate());

                    $( "#e_sdate" ).datepicker("option", "maxDate", dt);
                }
            });

            // hide message div on modal
            $('#msgDiv').hide();

            /** Update coupon **/
            $(document).on('click', 'a[data-role=edit]', function() {
                var id = $(this).data('id');                
                var code = $('#' + id).children('td[data-target=code]').text();
                var amount = $('#' + id).children('td[data-target=amount]').text();
                var type = $('#' + id).children('td[data-target=type]').text();
                var sdate = $('#' + id).children('td[data-target=sdate]').text();
                var edate = $('#' + id).children('td[data-target=edate]').text();
                var status = $('#' + id).children('td[data-target=status]').text();

                // Load edit modal with selected data from coupons table
                $('#e_id').val(id);
                $('#e_ccode').val(code);
                $('#e_amount').val(amount);
                $('#e_sdate').val(sdate);
                $('#e_edate').val(edate);

                var amountType = (type == 'Percentage') ? '1' : '2';
                $('#e_atype').val(amountType);

                $('#editCouponModal').modal('toggle');
            });


            // Now create event to get data from fields and update the database
            $('#update').click(function() {

                var id = $('#e_id').val();
                var code = $('#e_ccode').val();
                var amount = $('#e_amount').val();
                var type = $('#e_atype').val();
                var sdate = $('#e_sdate').val();
                var edate = $('#e_edate').val();

                $.ajax({
                    url:    '/admin/coupons/edit/' + code + '/' + amount + '/' + type + '/' + sdate + '/' + edate,
                    method:   'get',
                    success: function(data) { 
                        //alert('SUCCESS' +data);
                        $('#msgDiv').show();
                        $('#msg').html(data);

                        $('#' + id).children('td[data-target=code]').text(code);
                        $('#' + id).children('td[data-target=amount]').text(amount);
                        type = (type == 1) ? 'Percentage' : 'Fixed Rate';
                        $('#' + id).children('td[data-target=type]').text(type);
                        $('#' + id).children('td[data-target=sdate]').text(sdate);
                        $('#' + id).children('td[data-target=edate]').text(edate);

                        swal(data, {icon: "success"});

                        $('#editCouponModal').modal('hide');
                        //console.log(data);
                    },
                    error: function(data) {
                        swal(data, {icon: "error"});
                        //console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
                    }
                });
            });

            /** Delete coupon **/
            $(document).on('click', 'a[data-role=delete]', function() {
                var id = $(this).attr('rel');
                var status = $(this).attr('rel1');
                var title = (status == '1') ? 'DISABLE' : 'ENABLE';
                //alert('status >>>>>>>> ' +id);return false;
                
                swal({
                    title: title + " COUPON",
                    text: "Are you sure you want to "+ title +" this coupon?",
                    icon: "warning",
                    closeModal: false,
                    dangerMode: true,
                    buttons: ['CANCEL', 'YES, ' + title + ' IT!'],
                    closeOnClickOutside: false,
                })

                .then((isDelete) => {
                    if (isDelete) {
                        $.ajax({
                            url:    '/admin/coupons/delete/' + id,
                            method:   'get',
                            success: function(data) {                                 
                                status = (status == '1') ? 'Disabled' : 'Enabled';
                                $('#' + id).children('td[data-target=status]').text(status);

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