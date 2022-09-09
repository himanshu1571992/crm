<?php
$session_id = $this->session->userdata();

init_head();
?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                            <?php echo form_open($this->uri->uri_string(), array('id' => 'leadprojection-form', 'class' => 'lead-projection-form', 'onsubmit'=>"return checkform()")); ?>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label for="branch_id" class="control-label">Sales Person *</label>
                                            <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true" required="">
                                                <option value="" disabled="" selected>--Select One-</option>

                                                <?php
                                                if (!empty($sales_person_info)) {
                                                    foreach ($sales_person_info as $row) {
                                                        $selected = (!empty($s_staff_id) && ($row->sales_person_id == $s_staff_id)) ? 'selected=""':'';
                                                ?>
                                                        <option value="<?php echo $row->sales_person_id; ?>" <?php echo $selected; ?> ><?php echo cc(get_employee_name($row->sales_person_id)); ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" id="employee_div">
                                        <label for="month" class="control-label">Month *</label>
                                        <select required="" class="form-control selectpicker" id="month" name="month">
                                            <option value="" disabled selected >--Select One-</option>
                                            <?php
                                            if(!empty($month_list)){
                                                foreach($month_list as $row){
                                                    ?>
                                                    <option value="<?php echo $row->id; ?>" <?php echo (!empty($s_month) && $s_month == $row->id) ? 'selected' : "" ?>><?php echo $row->month_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" id="employee_div">
                                        <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                                        <select required="" class="form-control selectpicker" id="year" name="year">
                                            <option selected ></option>
                                            <?php
                                            $j = date('Y');
                                            for($i=$j; $i>=2022; $i--){
                                                ?>
                                                <option value="<?php echo $i;?>" <?php if(!empty($s_year) && $s_year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            <div class="col-md-12">
                                <br>
                                <?php if (!empty($lead_info)) { ?>
                                    <div class="col-sm-6 col-xs-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted text-warning">Pending</h3>
                                                <div class="row">
                                                    <span class="staff_logged_time_text col-sm-6">Counts :&nbsp;<span class="label label-info"><?php echo (!empty($pending_lead)) ? count($pending_lead) : 0; ?></span></span>
                                                    <span class="staff_logged_time_text col-sm-6">Amount :&nbsp;<span class="label label-info ttl_pending_amt">0</span></span>
                                                </div>
                                                <div class="btn-bottom-pusher"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 total-column">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <h3 class="text-muted text-success">Completed</h3>
                                                <div class="row">
                                                    <span class="staff_logged_time_text col-sm-6">Counts :&nbsp;<span class="label label-info"><?php echo (!empty($complate_lead)) ? count($complate_lead) : 0; ?></span></span>
                                                    <span class="staff_logged_time_text col-sm-6">Amount :&nbsp;<span class="label label-info ttl_complete_amt">0</span></span>
                                                </div>
                                                <div class="btn-bottom-pusher"></div>    
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php } ?>
                            </div>     
                            <div class="col-md-12">
                                <hr>
                                <div class="table-responsive" style="margin-bottom:30px;">
                                    <table class="table" id="newtable1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Lead #</th>
                                                <th>Customer Name</th>
                                                <th>Enq date</th>
                                                <th>Contacts</th>
                                                <th>Source</th>                                        
                                                <th>Status</th>                                       
                                                <th>Amount</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ttl_amount = 0;
                                            $i = 0;
                                            $ttl_complate_amt = $ttl_pending_amt = 0;
                                            if (!empty($lead_info)) {
                                                foreach ($lead_info as $key => $value) {

                                                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '" . $value->client_branch_id . "' ")->row();

                                                    $company = ($value->client_branch_id > 0 && !empty($client_info)) ? $client_info->client_branch_name : $value->company;
                                                    
                                                    $contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '" . $value->id . "' and c.phonenumber != '' ")->row();

                                                    //getting last quotation amount
                                                    $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '" . $value->id . "' order by id desc  ")->row();
                                                    $amount = (!empty($quotation_info)) ? $quotation_info->total : '0.00';
                                                    
                                                    $type = $this->db->query("SELECT * from `tblenquirytypemaster` where id = '" . $value->enquiry_type_id . "' ")->row_array();
                                                    $maintype = $this->db->query("SELECT * from `tblmainenquirytypemaster` where id = '".$value->enquiry_type_main_id."' ")->row_array();
                                                    if ($value->enquiry_type_main_id == 5){
                                                        $ttl_complate_amt += $amount;
                                                    }else{
                                                        $ttl_pending_amt += $amount;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$i; ?></td>                                                
                                                        <td>
                                                            <?php
                                                                echo '<a target="_blank" href="' . admin_url('leads/lead_profile/' . $value->id) . '"> LEAD-' . number_series($value->id) . '</a><br><br>';
                                                            ?>
                                                            <a target="_blank" href="<?php echo admin_url("follow_up/lead_activity/".$value->id); ?>" class="btn-sm btn-info">Activity</a>
                                                        </td>
                                                        <td><?php
                                                                echo cc($company);
                                                                echo '<br/><br/>';
                                                                echo '<label class="label label-defalt" style="color:' . $maintype['color'] . ';border:1px solid ' . $maintype['color'] . '">'.$maintype['name'].'</label>&nbsp;&nbsp;';
                                                                echo '<label class="label label-defalt" style="color:' . $type['color'] . ';border:1px solid ' . $type['color'] . '">'.$type['name'].'</label>';
                                                            ?>
                                                        </td>
                                                        <td><?php echo _d($value->enquiry_date); ?></td> 
                                                        <td>
                                                            <?php 
                                                                if (!empty($contact_info)) { ?>
                                                                        <a target="_blank" href="<?php echo admin_url('leads/lead_contact/' . $value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a><?php
                                                                } else {
                                                                    echo '--';
                                                                } 
                                                                cc(value_by_id('tblenquirytypemaster', $value->enquiry_type_id, 'name'));
                                                            ?>
                                                        </td>
                                                        <td><?php echo value_by_id('tblleadssources', $value->source, 'name'); ?></td>
                                                        <td>
                                                            <?php
                                                            $leadstatus = value_by_id("tblleadprocess", $value->process_id, "name");
                                                            if ($value->process_id == 6) {
                                                                $leadstatus = '<a href="javascript:void(0);" data-remark="' . cc($value->lost_remark) . '" class="lostremark" data-target="#showlostremark" data-toggle="modal">' . $leadstatus . '</a>';
                                                            }
                                                            echo $leadstatus;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                echo number_format($amount, 2, '.',',');
                                                                $ttl_amount += $amount;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                echo '<tr><td colspan="9" class="text-center"><h4>No Lead Assigned</h4></td></tr>';
                                            }
                                            ?>

                                        </tbody>
                                        <?php if ($ttl_amount > 0){ ?>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"><h4 class="text-center">Total Amount</h4></td>
                                                <td><h4><?php echo number_format($ttl_amount, 2, '.',','); ?></h4></td>
                                            </tr>
                                        </tfoot>
                                        <?php } ?> 

                                    </table>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
<?php init_tail(); ?>
</body>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
</html>
<script>
    var complated_amt = '<?php echo number_format($ttl_complate_amt, 2, '.', ','); ?>';
    var pending_amt = '<?php echo number_format($ttl_pending_amt, 2, '.', ','); ?>';
    $(".ttl_complete_amt").html(complated_amt);
    $(".ttl_pending_amt").html(pending_amt);
</script>
