<div id="deleteCatModal{{ $category->id }}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ url('/admin/categories/delete/' . $category->id) }}">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title">{{ $category->status == 0? 'Enable ' : 'Disable ' }} {{ $category->name }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to {{ $category->status == 0? 'Enable ' : 'Disable ' }} <strong>{{ $category->name }}?</strong></p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="NO">
          <input type="submit" class="btn btn-danger" value="YES, {{ $category->status == 0? 'ENABLE' : 'DISABLE ' }}">
        </div>
      </form>
    </div>
  </div>
</div>