@extends('layouts.adminLayout.admin_design')
@section('title', 'Add Product Attributes')

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
                                <li class="breadcrumb-item active" aria-current="page">Add Product Attributes</li>
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

                        <form class="form-horizontal"
                            action="{{ url('/admin/products/add-attributes/'. base64_encode($product->id)) }}"
                            method="post" id="frmAddAttribute" name="add_attribute">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Add Product Attributes</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-3 control-label col-form-label">
                                            <strong>{{ $product->product_name }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Product
                                        Color</label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-3 control-label col-form-label">
                                            <strong>{{ $product->product_color }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Product Code</label>
                                    <div class="col-sm-9">
                                        <label class="col-sm-3 control-label col-form-label">
                                            <strong>{{ $product->product_sku }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="field_wrapper">
                                    <div class="form-group row">
                                        <label for="weight"
                                            class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="color[]" id="color" value="" class="col-sm-3"
                                                placeholder="color" required />
                                            <input type="text" name="size[]" id="size" value="" class="col-sm-2"
                                                placeholder="size" required />
                                            <input type="text" name="price[]" id="price" value="" class="col-sm-2"
                                                placeholder="price" required />
                                            <input type="text" name="stock[]" id="stock" value="" class="col-sm-2"
                                                placeholder="stock" required />
                                            <input type="text" name="weight[]" id="weight" value="" class="col-sm-2"
                                                placeholder="weight" required />
                                            <a href="javascript:void(0);" class="add_button" title="Add field"><span
                                                    class="fa fa-plus-circle"> </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 text-right">
                                            <button type="submit" class="btn btn-success">Add Attributes</button>
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
                                            <th>ID</th>
                                            <th>SKU</th>
                                            <th>Color</th>
                                            <th>SIZE</th>
                                            <th>PRICE</th>
                                            <th>STOCK</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($product['attributes']) > 0) {?>

                                        @foreach($product['attributes'] as $attribute)

                                        <tr id="{{ $attribute->id }}">
                                            <td></td>
                                            <td data-target="sku">{{ $attribute->product_sku }}</td>
                                            <td data-target="color">{{ $attribute->product_color }}</td>
                                            <td data-target="size">{{ $attribute->size }}</td>
                                            <td data-target="price">{{ $attribute->price }}</td>
                                            <td data-target="stock">{{ $attribute->stock }}</td>
                                            <td>{{ $attribute->status == 1 ? 'Enable' : 'Disable' }}</td>
                                            <td>
                                                <a href="#" data-id="{{ $attribute->id }}" data-role="update"
                                                    class="btn btn-primary btn-sm fa fa-edit"
                                                    title="Edit {{ $attribute->sku }}" data-toggle="tooltip">
                                                    Edit</a> |

                                                <a class="btn btn-danger btn-sm deleteRecord" rel="{{ $attribute->id }}"
                                                    rel1="delete-attribute" rel2="{{ $attribute->status }}"
                                                    href="javascripts:"><i class="fa fa-eye-slash" data-toggle="tooltip"
                                                        title="Enable or Disable"></i></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                        <?php } else {?>

                                        <tr>
                                            <td colspan="6" class="text-danger">
                                                <strong>There is no attributes recorded for this product!</strong>
                                            </td>
                                        </tr>

                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>SKU</th>
                                            <th>Color</th>
                                            <th>SIZE</th>
                                            <th>PRICE</th>
                                            <th>STOCK</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Modal -->
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">                                            
                                            <h4 class="modal-title">Update Product Attributes</h4>
                                            <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="msgDiv" class="alert alert-success alert-block">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong><span id="msg"></span></strong>
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label>SIZE</label>
                                                <input type="text" id="e_color" readonly class="form-control color" />
                                            </div>
                                            <div class="form-group">
                                                <label>Color</label>
                                                <input type="text" id="e_size" readonly class="form-control size" />
                                            </div>
                                            <div class="form-group">
                                                <label>Color</label>
                                                <input type="text" id="e_weight" readonly class="form-control weight" />
                                            </div>
                                            <div class="form-group">
                                                <label>PRICE</label>
                                                <input type="text" id="e_price" class="form-control price" />
                                            </div>
                                            <div class="form-group">
                                                <label>stock</label>
                                                <input type="text" id="e_stock" class="form-control stock" />
                                                <input type="hidden" name="e_id" id="e_id" class="e_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" id="save" class="btn btn-success pull-right">Update</a href="#">
                                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
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

@section('page_script')
<!-- Form Validation -->
<script src="/js/backend_js/jquery.validate.min.js"></script>
<script src="/js/backend_js/additional-methods.js"></script>
<script src="/js/backend_js/datatables.min.js"></script>
<script src="/js/backend_js/bootstrap.min.js"></script>
<script src="/js/shared_js/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        $('#msgDiv').hide();

        /** Update attributes **/
        $(document).on('click', 'a[data-role=update]', function() {
            var id = $(this).data('id');
                        
            var weight = $('#' + id).children('td[data-target=weight]').text();
            var color = $('#' + id).children('td[data-target=color]').text();
            var size = $('#' + id).children('td[data-target=size]').text();
            var price = $('#' + id).children('td[data-target=price]').text();
            var stock = $('#' + id).children('td[data-target=stock]').text();
            
            // Load myModal with selected data from product attributes table
            $('#e_id').val(id);
            $('#e_weight').val(weight);
            $('#e_color').val(color);
            $('#e_size').val(size);
            $('#e_price').val(price);
            $('#e_stock').val(stock);

            $('#myModal').modal('toggle');
        });

        // Now create event to get data from fields and update the database
        $('#save').click(function() {

            var id = $('#e_id').val();
            var price = $('#e_price').val();
            var stock = $('#e_stock').val();

            $.ajax({
                url:    '/admin/products/edit-attributes/' + id + '/' + stock + '/' + price,
                method:   'get',
                success: function(data) { 
                    //alert('SUCCESS' +data);
                    $('#msgDiv').show();
                    $('#msg').html(data);

                    $('#' + id).children('td[data-target=price]').text(price);
                    $('#' + id).children('td[data-target=stock]').text(stock);
                    //console.log(data);
                },
                error: function(data) {
                    //console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
                }
            });
        });
        /** end #frmSetting validation **/

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><div class="form-group row"><label for="weight" class="col-sm-3 text-right control-label col-form-label"></label><div class="col-sm-6"><input type="text" name="color[]" id="color" value="" class="col-sm-3" placeholder="color" required/> <input type="text" name="size[]" id="size" value="" class="col-sm-2" placeholder="size" required/> <input type="text" name="price[]" id="price" value="" class="col-sm-2" placeholder="price" required/> <input type="text" name="stock[]" id="stock" value="" class="col-sm-2" placeholder="stock" required/> <input type="text" name="weight[]" id="weight" value="" class="col-sm-2" placeholder="weight" required/> <a href="javascript:void(0);" class="remove_button" title="Remove field"> <span class="fa fa-minus-circle text-danger"> </span></a></div></div></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).closest('div.form-group').remove(); //Remove field html
            x--; //Decrement field counter
        });


        // Delete product attribute
        $(".deleteRecord").click(function () {
            var id = $(this).attr('rel');
            var status = $(this).attr('rel2');
            var title = (status == '1') ? 'DISABLE' : 'ENABLE';

            swal({
                title: title + " PRODUCT ATTRIBUTE",
                text: "Are you sure you want to " + title + " this Attribute?",
                icon: "warning",
                closeModal: false,
                dangerMode: true,
                buttons: ['CANCEL', 'YES, ' + title + ' IT!'],
                closeOnClickOutside: false,
            })

            .then((isDelete) => {
                if (isDelete) {
                    //fetch("/admin/products/delete-attribute/" + id);
                    $.ajax({
                        url:    '/admin/products/delete-attribute/' + id,
                        method:   'get',
                        success: function(data) { 
                            //alert('SUCCESS' +data);
                            
                            $('#' + id).remove();
                            swal("Product attribute was " + title + "D successfully!", { icon: "success" });
                            //console.log(data);
                        },
                        error: function(data) {
                            //console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
                        }
                    });
                
                    //window.location.reload(true);
                } else {
                    swal("Cannot altered the product attribute!");
                }
            });
        });


        /****************************************
         *       Basic Table                   *
         ****************************************/
        var t = $('#zero_config').DataTable();

        // this will add autoincrement id to the datatable
        t.on('order.dt search.dt', function () {
            t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
</script>
@endsection