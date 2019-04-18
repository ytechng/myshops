<!-- Delete Modal HTML -->
<div id="categoryModal{{ $category->id }}" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">{{ $category->name }} Full Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Category ID: <strong>{{ $category->id }}</strong></p>
          <p>Category Name: <strong>{{ $category->name }}</strong></p>
          <p>Parent Category: <strong>{{ $category->parent_id }}</strong></p>
          <p>Category Status: <strong>{{ $category->status }}</strong>
          <p>Description: <strong>{{ $category->description }}</strong></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        </div>
      </form>
    </div>
  </div>
</div>