<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 75px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->

              <div id="wrapper">
                  <div class="content accounting-template">
                      <a data-toggle="modal" id="modal" data-target="#myModal"></a>
                      <div class="row">
                          <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?></h4>
                                           <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label for="client" class="control-label">Select Client</label>
                                                    <select class="form-control selectpicker clientselect" onchange="getclientbalanceamount(this.value);" required="" data-live-search="true" id="client_id" name="client_id">
                                                       <option value=""></option>
                                                        <?php
                                                            if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                                                foreach ($client_branch_data as $client_branch_value){
                                                                    echo $client_refund_info->client_id;
                                                                    echo $client_branch_value->userid;
                                                                    $select_cls = (isset($client_refund_info) && $client_refund_info->client_id == $client_branch_value->userid) ? 'selected=""':'';
                                                                    echo '<option value="'.$client_branch_value->userid.'" '.$select_cls.'>'.cc($client_branch_value->client_branch_name).'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label for="client" class="control-label">Refund Amount</label>
                                                    <!-- <input type="number" class="form-control refund-amt" max="<?php echo (isset($client_refund_info)) ? $client_refund_info->amount:'0'; ?>" step=".2" name="amount" value="<?php echo (isset($client_refund_info)) ? $client_refund_info->amount:''; ?>" > -->
                                                    <input type="text" class="form-control refund-amt" name="amount"  value="<?php echo (isset($client_refund_info)) ? $client_refund_info->amount:''; ?>">
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="status" class="control-label">Service Type</label>
                                                        <select class="form-control selectpicker" data-live-search="true" required="" name="service_type">
                                                            <option value=""></option>
                                                            <!-- <option value="3" <?php echo (isset($client_refund_info) && $client_refund_info->service_type == 3) ? 'selected' : ''; ?>>Both</option> -->
                                                            <option value="1" <?php echo (isset($client_refund_info) && $client_refund_info->service_type == 1) ? 'selected' : ''; ?>>Rent</option>
                                                            <option value="2" <?php echo (isset($client_refund_info) && $client_refund_info->service_type == 2) ? 'selected' : ''; ?>>Sales</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"> 
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="assign_production" class="control-label">Assign To</label>
                                                        <select class="form-control selectpicker" id="assign_to_production" required="" name="assignproductionid[]" multiple="" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php

                                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                                    ?>
                                                                    <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                                        <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                                        <?php
                                                                        foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                            ?>
                                                                            <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>"><?php echo $singstaff['firstname'] ?></option>
                                                                            <?php }
                                                                        ?>
                                                                    </optgroup>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="remark" class="control-label">Remark</label>
                                                            <textarea name="remark" rows="4" class="form-control"><?php echo (isset($client_refund_info)) ? cc($client_refund_info->remark) :""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                                           <button type="submit" class="btn btn-info submit-btn">
                                                <?php echo _l('send_for_approval'); ?>
                                            </button>
                                            <!-- <input type="submit" name="submit" class="btn btn-info submit-btn" value="<?php echo _l('send_for_approval'); ?>"> -->
                                            <!-- <a href="javascript:void(0);" class="btn btn-info submit-btn"><?php echo _l('send_for_approval'); ?></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php echo form_close(); ?>
            				        <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<script type="text/javascript">

function getclientbalanceamount(clientid){
  var url = "<?php echo admin_url('client/getclientbalanceamount/'); ?>";
  $.get(url+clientid, function(data){
       $(".refund-amt").val(data);
       // $(".refund-amt").attr("pattern", '[0-'+data+']+');
  });
}
</script>
</body>

</html>
