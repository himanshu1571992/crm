<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="">
                            <div class="col-md-12"> 
                                <div class="table-responsive">
                                <table class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th align="center">Payment ID</th>
                                            <th align="center">Category</th>
                                            <th align="center">Name</th>
                                            <th align="center">Amount</th>
                                            <th align="center">UTR No.</th>
                                            <th align="center">Date</th>
                                            <th align="center">Remark</th>
                                            <th align="center"> Cheque Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($payment_info)){
                                        $i=1;
                                        foreach($payment_info as $row){ 
                                            
                                            $cheque_status = "<span class='btn-sm btn-success'>NEFT</span>";
                                            if ($row->method == "CHEQUE"){
                                                switch ($row->chaque_status) {
                                                    case 0:
                                                        $cheque_status = "<span class='btn-sm btn-warning'>Pending</span>";
                                                        break;
                                                    case 1:
                                                        $cheque_status = "<span class='btn-sm btn-info'>Clear</span>";
                                                        break;
                                                    case 2:
                                                        $cheque_status = "<span class='btn-sm btn-danger'>Bounced</span>";
                                                        break;
                                                    case 3:
                                                        $cheque_status = "<span class='btn-sm btn-info' style='background-color: #d826f1'>Redeposit</span>";
                                                        break;
                                                    case 4:
                                                        $cheque_status = "<span class='btn-sm btn-danger'>Cancel</span>";
                                                        break;
                                                }
                                                
                                            }
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td align="center"><?php echo 'PAY-'.$row->main_id; ?></td>
                                                    <td align="center"><?php echo cc(value_by_id('tblcompanyexpensecatergory',$row->category_id,'name')); ?></td>
                                                    <td align="center">
                                                        <?php
                                                        if ($row->category_id == 1) {
                                                            $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where staffid = '" . $row->payee_id . "' ")->row();
                                                        } elseif ($row->category_id == 2) {
                                                            $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where id = '" . $row->payee_id . "' ")->row();
                                                        } else {
                                                            $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where id = '" . $row->payee_id . "' ")->row();
                                                        }

                                                        $payee_name = $payee_info->name;
                                                        echo cc($payee_name);
                                                        ?>
                                                    </td>
                                                    <td align="center"><?php echo $row->amount; ?></td>
                                                    <td align="center"><?php echo !empty($row->utr_no) ? $row->utr_no : "--"; ?></td>
                                                    <td align="center"><?php echo $row->date; ?></td>
                                                    <td align="center"><?php echo cc($row->first_remark); ?></td>
                                                    <td><?php echo $cheque_status; ?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                                </div>                                                            
                                
                            </div>
                        
                        

                               
                            </div>
                            
                        </div>
                      <div class="btn-bottom-toolbar text-right">
                                    <button class="btn btn-info" value="1" name="mark" type="submit">
                                        <?php echo _l('submit'); ?>
                                    </button>
                                </div>
                    </div>
                    </div>
                      
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script>

$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


</body>
</html>
