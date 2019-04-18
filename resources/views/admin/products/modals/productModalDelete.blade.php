<div id="deleteModal{{ $product->id }}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ url('/admin/products/delete/' . $product->id) }}">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">{{ $product->status == 0? 'Enable ' : 'Disable ' }} {{ $product->name }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to {{ $product->status == 0? 'Enable ' : 'Disable ' }} <strong>{{ $product->product_name }}?</strong></p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-danger" data-dismiss="modal" value="NO">
          <input type="submit" class="btn btn-default" value="YES">
        </div>
      </form>
    </div>
  </div>
</div>