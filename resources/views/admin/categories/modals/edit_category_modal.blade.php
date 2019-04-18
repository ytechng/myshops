<div id="editCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <input type="hidden" id="e_id">

            <div class="form-group row">
                <label for="e_name" class="col-sm-4 text-right control-label col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="e_name" placeholder="Category Name Here">
                </div>
            </div>
            <div class="form-group row">
                <label for="e_pid" class="col-sm-4 text-right control-label col-form-label">Category subCat</label>
                <div class="col-sm-6">
                    <select class="form-control" id="e_pid">
                        <option value="0">Main Category</option>
                        @foreach($subCategory as $subCat)
                            <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="e_desc" class="col-sm-4 text-right control-label col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="e_desc"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="e_url" class="col-sm-4 text-right control-label col-form-label">URL</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="e_url" placeholder="e.g electronics">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
          <a href="#" id="update" class="btn btn-success pull-right">Update</a href="#">
        </div>
    </div>
  </div>
</div>