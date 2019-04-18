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
            <?php $rowIndex = 0; ?>
            @if (count($userCart))  
            @foreach ($userCart as $cart)
              <?php $rowIndex++; ?>
                <tr>
                  <td> <img width="60" src="/images/backend_img/products/small/{{ $cart->product_image }}" alt="" /></td>
                  <td>{{ $cart->product_name }}<br />Color : {{$cart->product_color}}, Code : {{$cart->product_code}}</td>
                  <td>
                    <div class="input-append">
                      <input class="span1" style="max-width:34px" value="{{ $cart->quantity }}" 
                         size="20" type="number" autocomplete="off">
                      
                      <!-- <a class="btn btn-success" href="{{ url('/cart/update/plus/' . $cart->id) }}">
                        <i class="icon-remove icon-refresh"> </i> Update
                      </a> -->
                      <a class="btn btn-success" data-role="update" href="#" title="Update {{ $cart->product_name }}" 
                          data-id="{{ $cart->id }}" data-toggle="tooltip">
                        <i class="icon-remove icon-refresh"> </i> Update
                      </a>
                      <!--
                      <button class="btn btn-danger" id="minusCart{{ $rowIndex }}" type="button">
                        <i class="icon-minus"></i>
                      </button>
                      <button class="btn btn-primary" id="plusCart{{ $rowIndex }}" type="button">
                        <i class="icon-plus"></i>
                      </button>
                      -->
                      <a class="btn btn-danger" href="{{ url('/cart/delete/' . $cart->id) }}">
                        <i class="icon-remove icon-white"> </i> Delete
                      </a>                       
                    </div>
                  </td>
                  <td>{{ $cart->price }}</td>
                  <td>{{ $cart->price * $cart->quantity }}</td>
                </tr>
              @endforeach
            @else 
              <span style="color:red"><strong>There was no item added to this cart</strong></span>
            @endif
            <tr>
              <td colspan="4" style="text-align:right"><strong>TOTAL <!--($228 - $50 + $31) --> =</strong></td>
              <td class="label label-important" style="display:block"> <strong> 0.00 </strong></td>
            </tr>
          </tbody>
        </table>


        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>
                <form class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
                    <div class="controls">
                      <input type="text" class="input-medium" placeholder="CODE">
                      <button type="submit" class="btn"> ADD </button>
                    </div>
                  </div>
                </form>
              </td>
            </tr>

          </tbody>
        </table>

        <table class="table table-bordered">
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
        </table>
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

    $(document).on('click', 'a[data-role=update]', function() {
      alert('Gooooooood');
    });

  });

</script>
@endsection