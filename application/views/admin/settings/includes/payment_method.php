<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="email_config">
        <h4>Payment Method</h4>
        <hr/>
        <?php 
        if(isset($_GET['id']))
        {
           $this->db->where('id', $_GET['id']);
           $paymentmethod_data= $this->db->get('tblpaymentmethod')->row();
           $paymentmethod_data = (array) $paymentmethod_data;
        }?>
        <div class="col-md-6">
            <div class="form-group">
                <?php if(isset($_GET['id']))?> <input type="hidden" id="id" name="id" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
                <label for="name" class="control-label">Name</label>
                <input type="text" id="name" name="Payment[name]" class="form-control" required="" value="<?php echo (isset($paymentmethod_data['name']) && $paymentmethod_data['name'] != "") ? $paymentmethod_data['name'] : "" ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="account_no" class="control-label">Status</label>
                <select class="form-control selectpicker" name="Payment[status]" required="">
                    <option value=""></option>
                    <option value="1" <?php echo (isset($paymentmethod_data['status']) && $paymentmethod_data['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                    <option value="0" <?php echo (isset($paymentmethod_data['status']) && $paymentmethod_data['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                </select>
            </div>
        </div>
    </div>
        
    </div>
    
</div>
