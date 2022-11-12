<div class="modal-content ">
    <div class="modal-header">
    <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="color:#fff"> Financial Year Selection </h4>
    </div>
    <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
            <label for="module_id" class="control-label">Financial Year</label>
            <select class="form-control selectpicker" required="" data-live-search="true" id="financialyear_id" name="financialyear_id">
                <option value=""></option>
                <?php 
                    foreach ($financial_year_list as $value) {
                        $selectcls = ($value->id == financial_year()) ? 'selected' : '';
                        echo '<option value="'.$value->id.'" '.$selectcls.'>'.cc($value->name).'</option>';
                    }
                ?>
            </select>
            <span class='financial_year_msg text-danger' ></span>
        </div>
        <div class="col-md-6">
            <label for="module_id" class="control-label">Branch</label>
            <select class="form-control selectpicker comp_branch_id" required="" data-live-search="true" id="branch_id" name="branch_id">
                <option value=""></option>
                <?php 
                    foreach ($companybranch_list as $value) {
                        $selectedcls = ($value->id == $billing_branch_id) ? 'selected=""':'';
                        echo '<option value="'.$value->id.'" '.$selectedcls.'>'.cc($value->comp_branch_name).'</option>';
                    }
                ?>
            </select>
            <span class='company_branch_msg text-danger' ></span>
        </div>
        </div>
    </div>
    <div class="modal-footer">
    <input type="hidden" id="invoiceid" name="invoiceid" value="<?php echo $invoiceid; ?>">  
    <input type="hidden" id="billing_branch" name="billing_branch_id" value="<?php echo $billing_branch_id; ?>">  
    <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
    <button type="submit" autocomplete="off" class="btn btn-info fyearbtn">Renew Invoice</button>
    </div>
</div>