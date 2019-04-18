<!-- Modal -->
<div id="editBannerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form class="form-horizontal" action="{{ url('/admin/banners/edit/') }}" method="post" id="frmProduct" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">                                            
                    <h4 class="modal-title">Update Banner</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="image" class="col-sm-4 text-right control-label col-form-label">Banner Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="image" class="form-control" id="e_image" placeholder="Image url here">
                            <input type="hidden" name="id" id="e_id" class="e_id">
                        </div>
                    </div>  
                    
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" class="form-control" id="e_title" style="background: white;" placeholder="Title">                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-4 text-right control-label col-form-label">Description</label>
                        <div class="col-sm-6">
                            <textarea name="description" class="form-control" id="e_desc"></textarea>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="link" class="col-sm-4 text-right control-label col-form-label">Link</label>
                        <div class="col-sm-6">
                            <input type="text" name="link" class="form-control" id="e_link" placeholder="Link">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="linkto" class="col-sm-4 text-right control-label col-form-label">Link To Website</label>
                        <div class="col-sm-6">
                            <input type="radio" name="linkto" id="e_no" class="text-left" value="0" checked/> NO &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="linkto" id="e_yes" class="text-left" value="1"/> YES
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>