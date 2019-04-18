@extends('layouts.frontLayout.front_design')
@section('title', 'Cart')

@section('styles')
<link rel="stylesheet" href="/css/backend_css/multicheck.css">
<link href="/css/backend_css/dataTables.bootstrap4.css" rel="stylesheet">
@endsection

@section('content')

<div id="mainBody">
  <div class="container">
    <div class="row">
      <div class="span9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
          <li class="active">Cart</li>
        </ul>
        <h3> SHOPPING CART [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i
              class="icon-arrow-left"></i> Continue Shopping </a></h3>
        <hr class="soft" />

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

        <table class="table table-bordered">
          <tr>
            <th> I AM ALREADY REGISTERED </th>
          </tr>
          <tr>
            <td>
              <form class="form-horizontal">
                <div class="control-group">
                  <label class="control-label" for="inputUsername">Username</label>
                  <div class="controls">
                    <input type="text" id="inputUsername" placeholder="Username">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="inputPassword1">Password</label>
                  <div class="controls">
                    <input type="password" id="inputPassword1" placeholder="Password">
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn">Sign in</button> OR <a href="register.html" class="btn">Register
                      Now!</a>
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
                  </div>
                </div>
              </form>
            </td>
          </tr>
        </table>

        
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product</th>
              <th>Description</th>
              <th>Quantity/Update</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $rowIndex = 0; $totalAmount = 0.00; ?>
            @if (count($userCart))  

              @foreach ($userCart as $cart)
                <?php $rowIndex++; $totalAmount += ($cart->quantity * $cart->price); ?>
                  <tr id="{{ $cart->id }}" class="cart-row">
                    <td> 
                      <a href="{{ url('/product/' . base64_encode($cart->product_id)) }}">
                        <img width="60" src="/images/backend_img/products/small/{{ $cart->product_image }}" alt="" />
                      </a>
                    </td>
                    <td>{{ $cart->product_name }}<br />Color : {{$cart->product_color}}, Code : {{$cart->product_sku}}</td>
                    <td>
                      <div class="input-append">
                        <input class="span1 qty_input" id="qty{{ $cart->id }}" style="max-width:34px" value="{{ $cart->quantity }}" 
                          size="20" type="text" data-unit-price="{{ $cart->price }}" readonly autocomplete="off">
                        
                          <a data-id="minus-{{ $cart->id }}" class="btn" data-role="minusBtn" title="Reduce quantity" 
                            id="minusBtn{{ $cart->id }}">
                            <i class="icon-minus"></i>
                          </a>
                          <a data-id="plus-{{ $cart->id }}" class="btn" data-role="plusBtn" title="Increment quantity">
                            <i class="icon-plus"></i>
                          </a>
                          <a data-id="remove-{{ $cart->id }}" class="btn btn-danger" data-role="removeBtn" title="Remove row">
                            <i class="icon-remove icon-white"></i>
                          </a>                      
                      </div>
                    </td>
                    <td data-target="price" style="text-align:right">{{ $cart->price,2 }}</td>
                    <td data-target="amount" style="text-align:right">{{ $cart->price * $cart->quantity }}</td>
                  </tr>
                @endforeach

                @if (!empty(Session::get('coupon_amount')))
                <?php $coupon_amount = Session::get('coupon_amount'); ?>
                  <tr id="subTotal">
                    <td colspan="4" style="text-align:right">
                      <strong>SUB TOTAL =</strong>
                    </td>
                    <td class="label" style="display:block; text-align:right"> 
                      <strong> <span class="subTotal">{{ $totalAmount }}</span> </strong>
                    </td>
                  </tr>

                  <tr id="discount">
                    <td colspan="4" style="text-align:right">
                      <strong>COUPON DISCOUNT =</strong>
                    </td>
                    <td class="label" style="display:block; text-align:right"> 
                      <strong> <span class="discount">{{ $coupon_amount }}</span> </strong>
                    </td>
                  </tr>

                  <tr id="grandTotal">
                    <td colspan="4" style="text-align:right">
                      <strong>GRAND TOTAL = ₦</strong>
                    </td>
                    <td class="label label-important" style="display:block; text-align:right"> 
                      <strong> <span class="totalAmount">{{ $totalAmount - $coupon_amount }}</span> </strong>
                    </td>
                  </tr>
                @else
                  <tr id="totalAmount">
                    <td colspan="4" style="text-align:right">
                      <strong>TOTAL = ₦</strong>
                    </td>
                    <td class="label label-important" style="display:block; text-align:right"> 
                      <strong> <span class="totalAmount">{{ $totalAmount }}</span> </strong>
                    </td>
                  </tr>
                @endif              
              
            @else 
              <span style="color:red"><strong>There was no item added to this cart</strong></span>
            @endif            
          </tbody>
        </table>

        <table class="table table-bordered">
            <tr>
              <th>What would you like to do next? </th>
            </tr>
            <tr>
              <td>
                  <form class="form-horizontal" action="{{ url('/cart/apply-coupon/') }}" method="post">
                      @csrf
                      <div class="control-group">
                        <p>Choose if you have a voucher code you want to use.</p>
                        <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
                        <div class="controls">
                          <input type="text" class="input-medium" placeholder="CODE" name="coupon_code">
                          <button type="submit" class="btn" name="apply_coupon"> APPLY</button>
                        </div>
                      </div>
                  </form>
              </td>
            </tr>
          </table>

        <!-- <table class="table table-bordered">
          <tr>
            <th>ESTIMATE YOUR SHIPPING </th>
          </tr>
          <tr>
            <td>
              <form class="form-horizontal">
                <div class="control-group">
                  <label class="control-label" for="inputCountry">Country </label>
                  <div class="controls">
                    <input type="text" id="inputCountry" placeholder="Country">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="inputPost">Post Code/ Zipcode </label>
                  <div class="controls">
                    <input type="text" id="inputPost" placeholder="Postcode">
                  </div>
                </div>
                <div class="control-group">
                  <div class="controls">
                    <button type="submit" class="btn">ESTIMATE </button>
                  </div>
                </div>
              </form>
            </td>
          </tr>
        </table> -->
        <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
      </div>

      <!-- Sidebar ================================================== -->
      @include('layouts.frontLayout.front_sidebar')
      <!-- Sidebar end=============================================== -->

    </div>
  </div>
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
  $(document).ready(function() {

    // remove 1 from quantity on each click
    $(document).on('click', 'a[data-role=minusBtn]', function() {
      $('#subTotal').hide();
      $('#discount').hide();
      $('#grandTotal').show();

      var row = $(this).data('id');
      var col = row.split("-");

      var id = col[1];

      var qty = $('#qty'+id).val();
      qty = parseInt(qty);

      if (qty > 1) { // deduct from quantity
        qty = qty - 1;

        $.ajax({
            url:    '/cart/update/' + id + '/' + qty,
            method: 'get',
            success: function(data) { 
              
              var price = $('#' + id).children('td[data-target=price]').text();
              //var amount = $('#' + id).children('td[data-target=amount]').text();
              price = parseFloat(price);
              
              // update quantity with new value
              $('#qty'+id).val(qty);

              // set the new amount
              var amount = qty * price;
              $('#' + id).children('td[data-target=amount]').text(amount);

              //set the new total cart amount
              var totalAmt = 0;

              $('.cart-row').each(function() {
                var row = $('.qty_input', this);
                var unitPrice = $(row).data('unit-price'); 
                var quantity = $(row).val();

                totalAmt += unitPrice * quantity;
              });

              $('.totalAmount').text(totalAmt);

              console.log(data);
            },
            error: function(data) {
                console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
            }
        });

        $('#minusBtn'+id).attr("disabled", false);
      } else {
        $('#minusBtn'+id).attr("disabled", true);
        return false;
      }
    });

    // add 1 to quantity on each click
    $(document).on('click', 'a[data-role=plusBtn]', function() {
      $('#subTotal').hide();
      $('#discount').hide();
      $('#grandTotal').show();

      var row = $(this).data('id');
      var col = row.split("-");

      var id = col[1];

      var oldQty = $('#qty'+id).val();
      var newQty = parseInt(oldQty) + 1;

      $.ajax({
          url:    '/cart/update/' + id + '/' + newQty,
          method:   'get',
          success: function(data) { 

            if (data == 'Error') {
              alert('Low stock error');
               return false;
            }
            
            var price = $('#' + id).children('td[data-target=price]').text();
            //var amount = $('#' + id).children('td[data-target=amount]').text();
            price = parseFloat(price);

            // update quantity with new value
            $('#qty'+id).val(newQty);

            // set new amount
            var amount = newQty * price;
            $('#' + id).children('td[data-target=amount]').text(amount);

            //set the new total cart amount
            var totalAmt = 0;

            $('.cart-row').each(function() {
              var row = $('.qty_input', this);
              var unitPrice = $(row).data('unit-price'); 
              var quantity = $(row).val();

              totalAmt += unitPrice * quantity;
            });

            $('.totalAmount').text(totalAmt);

            console.log(data);
          },
          error: function(data) {
              console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
          }
      });

    });

    // remove row on each click
    $(document).on('click', 'a[data-role=removeBtn]', function(e) {
      e.preventDefault();

      $('#subTotal').hide();
      $('#discount').hide();
      $('#grandTotal').show();

      var rowId = $(this).data('id');
      var colSplit = rowId.split("-");
      var id = colSplit[1];
      //alert('id >>>>>>>>>>>>>>>>>>>>>>>>>  ' +id);

      $(this).closest('tr').remove(); //Remove field html

      $.ajax({
        url:    '/cart/delete/' + id,
        method:   'get',
        success: function(data) {
          
          console.log('Success >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);          
          
          //set the new total cart amount
          var totalAmt = 0;

          $('.cart-row').each(function() {
            var row = $('.qty_input', this);
            var unitPrice = $(row).data('unit-price'); 
            var quantity = $(row).val();

            totalAmt += unitPrice * quantity;
          });

          $('.totalAmount').text(totalAmt);
        },
        error: function(data) {
          console.log('Error >>>>>>>>>>>>>>>>>>>>>>>>>>>>> ', data);
        }

      });
      
    });

  });

</script>
@endsection