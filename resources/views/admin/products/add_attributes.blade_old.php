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
                                            <strong>{{ $product->product_code }}</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="field_wrapper">
                                    <div class="form-group row">
                                        <label for="weight"
                                            class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="sku[]" id="sku" value="" class="col-sm-3"
                                                placeholder="sku" required />
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
                            <form action="{{ url('/admin/products/edit-attributes/'. base64_encode($product->id)) }}"
                                method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>SKU</th>
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

                                            <tr>
                                                <td>              
                                                </td>
                                                <td>{{ $attribute->sku }}
                                                    <input type="hidden" name="id[]" value="{{ $attribute->id }}" />
                                                </td>
                                                <td>{{ $attribute->size }}</td>
                                                <td>
                                                    <input type="text" name="price[]" value="{{ $attribute->price }}" />
                                                </td>
                                                <td>
                                                    <input type="text" name="stock[]" value="{{ $attribute->stock }}" />
                                                </td>
                                                <td>{{ $attribute->status == 1 ? 'Enable' : 'Disable' }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-sm fa fa-edit" 
                                                    title="View {{ $attribute->sku }}" data-toggle="tooltip"> Update</button> |

                                                    <a class="btn btn-danger btn-sm deleteRecord"
                                                        rel="{{ $attribute->id }}" rel1="delete-attribute"
                                                        rel2="{{ $attribute->status }}" href="javascripts:"><i
                                                            class="fa fa-eye-slash" data-toggle="tooltip"
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
                                                <th>SIZE</th>
                                                <th>PRICE</th>
                                                <th>STOCK</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </form>
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
<script src="/js/backend_js/jquery.modal.min.js"></script>
<script src="/js/shared_js/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        /** end #frmSetting validation **/
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><div class="form-group row"><label for="weight" class="col-sm-3 text-right control-label col-form-label"></label><div class="col-sm-6"><input type="text" name="sku[]" id="sku" value="" class="col-sm-3" placeholder="sku" required/> <input type="text" name="size[]" id="size" value="" class="col-sm-2" placeholder="size" required/> <input type="text" name="price[]" id="price" value="" class="col-sm-2" placeholder="price" required/> <input type="text" name="stock[]" id="stock" value="" class="col-sm-2" placeholder="stock" required/> <input type="text" name="weight[]" id="weight" value="" class="col-sm-2" placeholder="weight" required/> <a href="javascript:void(0);" class="remove_button" title="Remove field"> <span class="fa fa-minus-circle text-danger"> </span></a></div></div></div>'; //New input field html
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
                        fetch("/admin/products/delete-attribute/" + id);
                        swal("Product attribute was " + title + "D successfully!", { icon: "success" });
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
        t.on('order.dt search.dt', function () {
            t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
</script>
@endsection