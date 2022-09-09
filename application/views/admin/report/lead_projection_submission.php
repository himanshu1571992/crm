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
                            <div class="col-md-12" id="salesparson_remark">
                                <div class="form-group">
                                    <label for="salesparson_remark" class="control-label">Remark</label>
                                    <textarea rows="5" required name="salesparson_remark" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ttl_amount = 0;
                                            $i = 0;
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
                                                    
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$i; ?></td>                                                
                                                        <td>
                                                            <?php
                                                                echo '<a target="_blank" href="' . admin_url('leads/lead_profile/' . $value->id) . '"> LEAD-' . number_series($value->id) . '</a>';
                                                            ?>
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
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input lead_ids" type="checkbox" name="lead_id[]" value="<?php echo $value->id; ?>">
                                                            </div>    
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
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">
                                    <?php echo 'Submit'; ?>
                                </button>
                                <!-- <a href="javascript:void(0);" class="btn btn-info">Submit</a> -->
                            </div>
                        <?php echo form_close(); ?>                    
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
<script>
    function checkform(evt)    {     
            
        var count = 0;
        $(".lead_ids").each(function(){
            if ($(this).prop('checked')==true){ 
                count++;
            }
        });
        var condition = true;
        if (count == 0){
            alert("Please check at least one lead."); 
            condition = false;
            return false;
        }
        if(condition){
            condition =  confirm('Do you want to submit the form?');
            return true;
        }
        // var ttlreceived_qty = document.getElementById("total_received_qty").value;
        // var ttlaccepted_qty = document.getElementById("total_accepted_qty").value;
        // var ttlrejected_qty = document.getElementById("total_rejected_qty").value;
        // var ttlqty = parseFloat(ttlaccepted_qty) + parseFloat(ttlrejected_qty);
        // var condition = true;
        // if (ttlqty != ttlreceived_qty){
        //     alert("Total Accepted Qty and Rejected Qty equals to Total Received Qty."); 
        //     condition = false;
        //     return false;
        // }
        // if(condition){
        //     condition =  confirm('Do you want to submit the form?');
        //     return true;
        // }
    }

</script>
</html>

