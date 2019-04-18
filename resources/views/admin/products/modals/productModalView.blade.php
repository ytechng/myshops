<!-- Delete Modal HTML -->
<div id="productModal{{ $product->id }}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">{{ $product->product_name }} Full Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Product ID: <strong>{{ $product->id }}</strong></p>
          <p>Category ID: <strong>{{ $product->category_id }}</strong></p>
          <p>Product Code: <strong>{{ $product->product_code }}</strong></p>
          <p>Product Color: <strong>{{ $product->product_color }}</strong></p>
          <p>Product Price: <strong>{{ $product->product_price }}</strong></p>
          <p>Description: <strong>{{ $product->description }}</strong></p>
          <p>Added By: <strong>{{ $product->owner_name }}</strong></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        </div>
      </form>
    </div>
  </div>
</div>