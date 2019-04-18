@extends('layouts.frontLayout.front_design')
@section('title', $product->product_name )

@section('styles')
<link href="/css/frontend_css/easyzoom.css" rel="stylesheet" />
@endsection

@section('content')

<div id="mainBody">
    <div class="container">
        <div class="row">
            <div class="span9">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
                    <li><a href="{{ url('/products/') }}">Products</a> <span class="divider">/</span></li>
                    <li class="active">product Details</li>
                </ul>

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
                    <div class="span3">
                        <a href="#" title="{{ $product->product_name }}">
                            <img id="mainImage" src="/images/backend_img/products/small/{{ $product->product_image }}"
                                style="width:100%" alt="{{ $product->product_name }}" />
                        </a>
                        @if (count($productImages) > 0)
                        <div id="differentview" class="moreOptopm carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach ($productImages as $pi)
                                    <a href="#">
                                        <img style="width:29%" class="changeImage" id="change{{ $pi->id }}"
                                            src="/images/backend_img/products/small/{{ $pi->product_image }}"
                                            alt="{{ $product->product_name }}" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <!--  
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
                            -->
                        </div>
                        @endif
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <span class="btn"><i class="icon-envelope"></i></span>
                                <span class="btn"><i class="icon-print"></i></span>
                                <span class="btn"><i class="icon-zoom-in"></i></span>
                                <span class="btn"><i class="icon-star"></i></span>
                                <span class="btn"><i class=" icon-thumbs-up"></i></span>
                                <span class="btn"><i class="icon-thumbs-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <h3>{{ $product->product_name }}</h3>
                        <small>- SKU: {{ $product->product_sku }}</small>
                        <hr class="soft" />
                        <form id="addToCartForm" name="addToCartForm" class="form-horizontal qtyFrm" action="{{ url('/add-cart') }}">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                            <input type="hidden" name="product_name" value="{{ $product->product_name }}"/>
                            <input type="hidden" name="product_sku" id="sku" value="{{ $product->product_sku }}"/>
                            <input type="hidden" name="product_color" id="color" value="{{ $product->product_color }}"/>
                            <input type="hidden" name="price" id="price" value="{{ $product->product_price }}"/>
                            <input type="hidden" name="size" id="size" value="{{ $product->size }}"/>
                            <input type="hidden" name="merchant_id" value="{{ $product->merchant_id }}"/>

                            <div class="control-group">
                                <label class="control-label"><span id="getPrice">
                                    ₦{{ number_format($product->product_price, 2) }}</span>
                                </label>
                                <div class="controls">
                                    <input type="number" name="quantity" class="span1" value="1" />

                                    <button type="submit" class="btn btn-sm btn-primary pull-right"
                                        {{ $product->stock > 0 ? '':'disabled' }} id="cartBtn">
                                        Add to cart <i class=" icon-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr class="soft" />
                        <h5>
                            <span>Availability: </span>
                            <span id="availability">
                                @if ($product->stock > 0) 
                                    <span style="color:green">In Stock</span> 
                                @else 
                                    <span style="color:red">Out Of Stock</span> 
                                @endif 
                            </span>
                            (<span id="getStock">{{ $product->stock }}</span>)

                        </h5>
                        <form class="form-horizontal qtyFrm pull-right">
                            <div class="control-group">
                                <label class="control-label" style="color:brown;"><span><strong>SELECT
                                            SIZE</strong></span></label>
                                <div class="controls">
                                    <select class="span2" name="ptSize" id="selectedSize">
                                        <option value="-1">== Select ==</option>
                                        @foreach ($product->attributes as $pt)
                                        <option value="{{ $product->id }}-{{ $pt->size }}">{{ $pt->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <hr class="soft clr" />
                        <p>{{ $product->description }}</p>

                        <a class="btn btn-small pull-right" href="#detail">More Details</a>
                        <br class="clr" />
                        <a href="#" name="detail"></a>
                        <hr class="soft" />
                    </div>

                    <div class="span9">
                        <ul id="productDetail" class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                            <li><a href="#profile" data-toggle="tab">Related Products</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <h4>Product Information</h4>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="techSpecRow">
                                            <th colspan="2">Product Details</th>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Brand: </td>
                                            <td class="techSpecTD2">Fujifilm</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Model:</td>
                                            <td class="techSpecTD2">FinePix S2950HD</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Released on:</td>
                                            <td class="techSpecTD2"> 2011-01-28</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Dimensions:</td>
                                            <td class="techSpecTD2"> 75 pounds</td>
                                        </tr>
                                        <tr class="techSpecRow">
                                            <td class="techSpecTD1">Display size:</td>
                                            <td class="techSpecTD2">3</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5>Features</h5>
                                <p>14 Megapixels. 18.0 x Optical Zoom. 3.0-inch LCD Screen. Full HD photos and 1280 x
                                    720p HD movie capture. ISO sensitivity ISO6400 at reduced resolution. Tracking Auto
                                    Focus. Motion Panorama Mode.
                                    Face Detection technology with Blink detection and Smile and shoot mode. 4 x AA
                                    batteries not included. WxDxH 110.2 ×81.4x73.4mm. Weight 0.341kg (excluding battery
                                    and memory card). Weight 0.437kg (including battery and memory card).<br /></p>
                            </div>

                            <div class="tab-pane fade" id="profile">
                                <div id="myTab" class="pull-right">
                                    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                                class="icon-list"></i></span></a>
                                    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i
                                                class="icon-th-large"></i></span></a>
                                </div>
                                <br class="clr" />
                                <hr class="soft" />
                                <div class="tab-content">
                                    <div class="tab-pane" id="listView">
                                        @foreach ($relatedProducts as $related)
                                        <div class="row">
                                            <div class="span2">
                                                <img src="/images/backend_img/products/small/{{ $related->product_image }}"
                                                    alt="" />
                                            </div>
                                            <div class="span4">
                                                <h3>New | Available</h3>
                                                <hr class="soft" />
                                                <h5>{{ $related->product_name }} </h5>
                                                <p>{{ $related->description }}</p>
                                                <a class="btn btn-small pull-right"
                                                    href="{{ url('/product/' .base64_encode($related->id)) }}">View
                                                    Details</a>
                                                <br class="clr" />
                                            </div>
                                            <div class="span3 alignR">
                                                <form class="form-horizontal qtyFrm">
                                                    <h3>₦{{ number_format($related->product_price) }}</h3>
                                                    <label class="checkbox">
                                                        <input type="checkbox"> Adds product to compair
                                                    </label><br />
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-primary"> Add to <i
                                                                class=" icon-shopping-cart"></i></a>
                                                        <a href="#" class="btn btn-sm"><i class="icon-zoom-in"></i></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <hr class="soft" />
                                        @endforeach
                                    </div>

                                    <div class="tab-pane  active" id="blockView">
                                        <ul class="thumbnails">
                                            @foreach ($relatedProducts as $related)
                                            <li class="span3">
                                                <div class="thumbnail">
                                                    <a href="{{ url('/product/' .base64_encode($related->id)) }}"><img
                                                            src="/images/backend_img/products/small/{{ $related->product_image }}"
                                                            alt="{{ $related->product_name }}" /></a>
                                                    <div class="caption">
                                                        <h5>{{ $related->product_name }}</h5>
                                                        <p>
                                                            {{ $related->description }}
                                                        </p>
                                                        <h4 style="text-align:center"><a class="btn"
                                                                href="{{ url('/product/' .base64_encode($related->id)) }}">
                                                                <i class="icon-zoom-in"></i></a> <a class="btn"
                                                                href="#">Add to <i class="icon-shopping-cart"></i></a>
                                                            <a class="btn btn-primary"
                                                                href="#">₦{{ $related->product_price }}</a></h4>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <hr class="soft" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar ================================================== -->
            @include('layouts.frontLayout.front_sidebar')
            <!-- Sidebar end=============================================== -->

        </div>
    </div>
</div>
@endsection

@section('page_script')
<script src="/js/frontend_js/easyzoom.js"></script>

<script>
    $(document).ready(function () {
        
        // change product price and stock with size
        $('#selectedSize').change(function () {
            var ptSize = $(this).val();

            if (ptSize === '-1') {
                alert('Please select size');
                return false;
            }

            $.ajax({
                type: 'get',
                url: '/get-product-attribute',
                data: { ptSize: ptSize },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    console.log(resp);

                    $('#getPrice').html("₦" + resp.price);
                    $('#getStock').html(resp.stock);
                    $('#price').val(resp.price);
                    $('#size').val(resp.size);
                    $('#sku').val(resp.product_sku);

                    if (resp.stock == 0) {
                        $('#cartBtn').attr("disabled", true);
                        $('#availability').attr('color', 'red');
                        $('#availability').text('Out Of Stock');
                    } else {
                        $('#cartBtn').attr("disabled", false);
                        $('#availability').css('color', 'green');
                        $('#availability').text('In Stock');
                    }
                },
                error: function () {
                    alert('Error');
                }
            });
        });

        // change product image
        $('.changeImage').click(function () {
            var changeId = $(this).attr('id');
            var image = $(this).attr('src');
            var bigImage = $('#mainImage').attr('src');

            $('#mainImage').attr('src', image);
            $('#' + changeId).attr('src', bigImage);
        });
    });

</script>
@endsection