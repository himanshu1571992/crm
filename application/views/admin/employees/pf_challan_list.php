
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

</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('employees/add_pf_challan'); ?>" type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Add PF Challan</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {echo $f_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {echo $t_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">     
                                <hr>
                                <div class="table-responsive">                                                         
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th width="10%">Challan No</th>
                                                <th >Challan Date</th>                               
                                                <th>Employee Contribution</th>                               
                                                <th>Employer Contribution</th>
                                                <th>PF Admin</th>
                                                <th>PF Edli</th>
                                                <th>Total Amount</th> 
                                                <th>Adjustment Amount</th>                              
                                                <th width="25%">Link To Deduction</th>                               
                                                <th width="35%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $employee_amt = $employer_amt = $pf_admin = $pf_edli = $final_total_amount = $final_adjusted_amt = 0;
                                            if(!empty($pf_challan_list)){
                                                $z=1;
                                                foreach($pf_challan_list as $row){ 
                                                    $chk_tds_link = $this->db->query("SELECT GROUP_CONCAT(id) as ids FROM tblemployee_pf_esic_deduction WHERE challan_id = '".$row->id."'")->row();

                                                    $total_amount = ($row->employee_contribution+$row->employer_contribution+$row->pf_admin+$row->pf_edli);
                                                    $adjusted_data = $this->db->query("SELECT COALESCE(SUM(`employee_contribution`),0) as t1, COALESCE(SUM(`employer_contribution`),0) as t2, COALESCE(SUM(`pf_admin`),0) as t3, COALESCE(SUM(`pf_edli`),0) as t4 FROM `tblemployee_pf_esic_deduction` WHERE challan_id = '".$row->id."' ")->row();
                                                    $adjusted_amt = ($adjusted_data->t1+$adjusted_data->t2+$adjusted_data->t3+$adjusted_data->t4);
                                                    
                                                    $employee_amt += $row->employee_contribution;
                                                    $employer_amt += $row->employer_contribution;
                                                    $pf_admin += $row->pf_admin;
                                                    $pf_edli += $row->pf_edli;
                                                    $final_total_amount += $total_amount;
                                                    $final_adjusted_amt += $adjusted_amt;
                                            ?>                                                                                      
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo $row->challan_no;?></td>
                                                        <td><?php echo _d($row->challan_date);?></td>
                                                        <td><?php echo $row->employee_contribution; ?></td>
                                                        <td><?php echo $row->employer_contribution; ?></td>
                                                        <td><?php echo $row->pf_admin; ?></td>
                                                        <td><?php echo $row->pf_edli; ?></td>
                                                        <td><?php echo number_format($total_amount, '2'); ?></td>
                                                        <td><?php echo number_format($adjusted_amt, '2'); ?></td>
                                                        <td>
                                                            <?php 
                                                                if ($row->Interested_late_fees_payment == 0){
                                                                    if (!empty($chk_tds_link->ids)){ 
                                                                        echo '<a href="javascript:void(0);"  class="btn-sm btn-success tdschallan_id" data-tds_id="'.$chk_tds_link->ids.'" data-challan_id="'.$row->id.'" >Linked Deduction</a>';
                                                                    }else{
                                                                        echo '<a href="javascript:void(0);" data-tds_id="0" data-challan_id="'.$row->id.'"  class="btn-sm btn-info tdschallan_id"><i class="fa fa-plus"></i> Link To Deduction</a>';
                                                                    }
                                                                }else{
                                                                    echo 'Interested Late Fees Payment';
                                                                }
                                                            ?>    
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo admin_url('employees/add_pf_challan/'.$row->id);?>" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                            <a href="<?php echo admin_url('employees/view_pf_challan/'.$row->id);?>" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="<?php echo admin_url('employees/delete_pf_challan/'.$row->id);?>" class="btn-sm btn-danger _delete"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>                  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"><center style="font-size: 20px;">Total</center></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($employee_amt, '2'); ?></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($employer_amt, '2'); ?></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($pf_admin, '2'); ?></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($pf_edli, '2'); ?></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($final_total_amount, '2'); ?></td>
                                                <td style="font-size: 15px;color:red;"><?php echo number_format($final_adjusted_amt, '2'); ?></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<!-- Modal -->
<div id="tdschallan_model" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("employees/linkChallanDeduction"), array('id' => 'tdschallan-form', 'class' => 'tdschallan_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Link PF Deduction</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tds_challan_id" class="control-label">PF Deduction</label>
                                <select name="pf_deduction_id[]" class="form-control selectpicker" required='' data-live-search="true" id="tds_challanid" multiple>
                                    <option value=""></option>
                                    
                                </select>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pfchallan_id" value="0" id="tdschallan_id">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php init_tail(); ?>

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

$(document).ready(function() {
    $('#newtable').DataTable( {
        
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>

<script type="text/javascript">
   

    $('.tdschallan_id').click(function(){
        var challan_id = $(this).data("challan_id");
        $("#tdschallan_id").val(challan_id);
        var tds_id = $(this).data("tds_id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/employees/get_pf_deduction'); ?>",
            data    : {'deduction_id' : tds_id, 'pfchallan_id' : challan_id},
            success : function(response){
                if(response != ''){
                    $("#tds_challanid").html(response);
                    $('.selectpicker').selectpicker('refresh');
                    $("#tdschallan_model").modal("show");
                }else{
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
        
    });
</script> 

</body>
</html>
