<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}

.card-outline-success {
    border: 5px groove #ddd !important;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <?php echo form_open($this->uri->uri_string(), array('id' => 'allot-item-form', 'class' => '_item_form allot-item-form')); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> </h4>
                        <hr class="hr-panel-heading">
                        <fieldset class="scheduler-border">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Date</h4>
                                            <p><?php echo (isset($vehiclebooking_data)) ? $vehiclebooking_data->date : "--"; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Transporter Name</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->transporter_name)) ? cc($vehiclebooking_data->transporter_name) : "--"; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Pan No.</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->pan_no)) ? cc($vehiclebooking_data->pan_no) : "--"; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($vehiclebooking_data) && $vehiclebooking_data->with_without_gst == 1){ ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">With GST</h4>
                                            <?php
                                                $withgst = "No";
                                                if(isset($vehiclebooking_data) && !empty($vehiclebooking_data->with_without_gst)){
                                                   $withgst = ($vehiclebooking_data->with_without_gst == 1) ? "Yes" : "No";
                                                }
                                            ?>
                                            <p><?php echo $withgst; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">TDS Amount</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->tds_amt)) ? $vehiclebooking_data->tds_amt : 0.00; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">TDS Percentage</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->tds_percent)) ? cc($vehiclebooking_data->tds_percent) : 0; ?>%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Booking Amount</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->booking_amt)) ? $vehiclebooking_data->booking_amt : 0.00; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Basic Amount</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->basic_amt)) ? $vehiclebooking_data->basic_amt : 0.00; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h4 class="control-label">Final Amount</h4>
                                            <p><?php echo (isset($vehiclebooking_data) && !empty($vehiclebooking_data->final_amt)) ? cc($vehiclebooking_data->final_amt) : 0.00; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
        <?php
            if (isset($vehiclebooking_data) && !empty($vehiclebooking_data->trip_id)){
                $challan_ids = value_by_id('tblchallantrip',$vehiclebooking_data->trip_id,'challan_ids');
                $getchallan_data = $this->db->query("SELECT * FROM tblchallanprocess WHERE `id` IN (".$challan_ids.")")->result();
                if (!empty($getchallan_data)){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"> Booking Process </h4>
                        <hr class="hr-panel-heading">
                        <?php foreach ($getchallan_data as $key => $sval) {
                            $getchallandetails = $this->db->query("SELECT `chalanno`,`clientid` FROM tblchalanmst WHERE `id` = '" . $sval->chalan_id . "'")->row();
                            $challan_number = (!empty($getchallandetails)) ? $getchallandetails->chalanno : "";
                            $client_name = (!empty($getchallandetails) && $getchallandetails->clientid > 0) ? client_info($getchallandetails->clientid)->client_branch_name : "";
                            
                            $cls = ($key%2) ? "panel-info" : "panel-success";
                        ?>
                        <div class="col-lg-6">
                            <div class="panel <?php echo $cls; ?>">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12 text-right">
                                            <p class="announcement-text"><?php echo $client_name; ?><br> <span class="text-danger">(<?php echo $challan_number; ?>) </span></p>
                                            <p class="announcement-text"></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo admin_url("Chalan/pdf/".$sval->chalan_id);?>" target="_blank">
                                    <div class="panel-footer announcement-bottom">
                                        <div class="row">
                                            <div class="col-xs-12 text-right">
                                                View PDF
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
            <?php }} ?>
        
        <div class="row">
            <?php
            if (isset($vehiclebooking_data)){
                $getreadby_data = $this->db->query("SELECT * FROM tblmasterapproval WHERE `module_id` = 26 AND `table_id` = ".$vehiclebooking_data->id."")->result();
                if (!empty($getreadby_data)){
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"> Approval Details </h4>
                        <hr class="hr-panel-heading">
                        <div class="panel panel-info">
                            <?php foreach ($getreadby_data as $value) { ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <h4 class="product-name"><strong><?php echo get_employee_fullname($value->staff_id); ?></strong></h4>
                                        <p class="text-danger">Read At - (<?php echo (!empty($value->readdate)) ? _d($value->readdate) : "--"; ?>)</p>
                                    </div>
                                    <div class="col-xs-2">
                                        <?php if ($value->approve_status == 0) { 
                                            $cls = "text-warning";
                                            $status = "Pending";
                                        }elseif ($value->approve_status == 1) {
                                            $cls = "text-success";
                                            $status = "Approved";            
                                        }elseif ($value->approve_status == 2) {
                                            $cls = "text-danger";
                                            $status = "Rejected";            
                                        }; ?>
                                        <br>
                                        <p class="<?php echo $cls;?>"><?php echo $status;?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
            <?php }} ?>
            <?php if($page=="approval"){?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php
                        if (empty($appvoal_info)) {
                            ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>


                                <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approve
                                </button>
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>  
            <?php } ?>
        </div>
        
        <?php echo form_close(); ?>
    </div>
<?php init_tail(); ?>
</body>
</html>
