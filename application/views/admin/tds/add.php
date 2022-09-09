<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo admin_url('tds/add'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" required="" id="assign" name="assignid[]">
                                    <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                            ?>
                                            <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                <?php
                                                foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                    ?>
                                                    <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                    if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                        echo'selected';
                                                    }
                                                    ?>><?php echo $singstaff['firstname'] ?></option>
                                                        <?php }
                                                        ?>
                                            </optgroup>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>                                

                            </div>

                            <div  class="col-md-6">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea class="form-control" name="remark" id="remark"><?php echo (isset($purchase_info) && $purchase_info['remark'] != '') ? $purchase_info['remark'] : ""; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Customer</th>
                                        <th>Payment for</th>
                                        <th>Invoice/Debitnote</th>                               
                                        <th>TDS %</th>
                                        <th>TDS Amount</th>
                                        <th>TDS Paid</th>
                                        <th>TDS Balance</th>
                                        <th>Action</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($tds_info)){
                                        $z=1;
                                        foreach($tds_info as $row){ 
                                                if($row->paymentmethod != 2){
                                                    $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$row->debitnote_no."' ")->row();
                                                    $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$row->debitnote_no."' ")->row();  
                                                }
                                               
                                               $client_info = client_info($row->client_id);

                                               $tds_bal = ($row->tds_amt - $row->paid_tds_amt);
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><a target="_blank" href="<?php echo admin_url('clients/client/'.$row->client_id); ?>"><?php echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';  ?> </a></td>
                                                <td><?php echo ($row->paymentmethod == 2) ? 'Invoice' : 'Debitnote';  ?></td>
                                                <?php
                                                if($row->paymentmethod == 2){
                                                    ?>
                                                    
                                                    <td><?php echo '<a target="_blank" href="' . admin_url('invoices/list_invoices/' . $row->invoiceid) . '">' . format_invoice_number($row->invoiceid) . '</a>'; ?></td>
                                                    <?php
                                                }else{
                                                    if(!empty($debit_info)){
                                                        echo '<td><a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
                                                    }elseif(!empty($debitpayment_info)){
                                                        echo '<td><a target="_blank" href="' . admin_url('debit_note/download_paymentpdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
                                                    }else{
                                                        echo '<td>--</td>';
                                                    }
                                                }
                                                ?>
                                                                                                                                    
                                                <td><?php echo $row->tds;?></td>
                                                <td><?php echo $row->tds_amt;?></td>
                                                <td><?php echo $row->paid_tds_amt;?></td>
                                                <td><input type="number" step="any" name="amount_<?php echo $row->id; ?>" value="<?php echo $tds_bal; ?>"></td>
                                                <td class="text-center"><input type="checkbox" value="<?php echo $row->id; ?>" name="row[]"></td>
                                            
                                                
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>                             

                        </div>

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            </form>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 25
    } );
} );
</script>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>
