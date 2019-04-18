<div id="deleteImageModal{{ $product->id }}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Delete Product Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete image for <strong>{{ $product->product_name }}?</strong></p>
        <p class="text-warning"><small>This action cannot be undone.</small></p>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="NO">
        <a href="{{ url('/admin/products/delete/image/' . base64_encode($product->id)) }}"
          class="btn btn-danger deleteBtn">YES</a>
      </div>
    </div>
  </div>
</div>