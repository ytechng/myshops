<!-- Modal -->
<div id="editCouponModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">                                            
                <h4 class="modal-title">Update Coupon</h4>
                <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
                <div class="form-group row">
                    <label for="coupon_code" class="col-sm-3 text-right control-label col-form-label">Coupon Code</label>
                    <div class="col-sm-5">
                        <input type="text" name="coupon_code" class="form-control" id="e_ccode" readonly 
                            style="background: white;" placeholder="coupon code">
                        <input type="hidden" name="e_id" id="e_id" class="e_id">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 text-right control-label col-form-label">Amount</label>
                    <div class="col-sm-5">
                        <input type="text" name="amount" class="form-control" id="e_amount" min="0" placeholder="e.g 1000">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount_type" class="col-sm-3 text-right control-label col-form-label">Amount Type</label>
                    <div class="col-sm-5">
                        <select name="amount_type" class="form-control" id="e_atype">
                            <option value="1">Percentage</option>
                            <option value="2">Flat Rate</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="start_date" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                    <div class="col-sm-5">
                        <input type="text" name="start_date" class="form-control" id="e_sdate" placeholder="start date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry_date" class="col-sm-3 text-right control-label col-form-label">Expiry Date</label>
                    <div class="col-sm-5">
                        <input type="text" name="expiry_date" class="form-control" id="e_edate" placeholder="expiry date">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="update" class="btn btn-success pull-right">Update</a href="#">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>