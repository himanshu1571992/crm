
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
                                <a href="<?php echo admin_url('employees/pf_challan_list'); ?>" type="submit" class="btn btn-info"> PF Challan List</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="year" class="control-label"><?php echo 'Year'; ?> *</label>
                                <select class="form-control" id="year" name="year">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    $j = date('Y');
                                    for ($i = 2017; $i <= $j; $i++) {
                                            $select_cls1 = (!empty($year) && $year == $i) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo $select_cls1; ?>  ><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="month" class="control-label"><?php echo 'Month'; ?> *</label>
                                <select class="form-control" id="month" name="month">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if (!empty($month_info)) {
                                        foreach ($month_info as $row) {
                                            $select_cls = (!empty($month) && $month == $row->id) ? 'selected' : '';
                                    ?>
                                            <option value="<?php echo $row->id; ?>" <?php echo $select_cls;?>  ><?php echo $row->month_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                            </div>
                            <div class="col-md-12">     
                                <hr>
                                <div class="table-responsive">                                                         
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Employee Name</th>
                                                <th>Month / Year</th>                               
                                                <th>Employee Contribution</th>                               
                                                <th>Employer Contribution</th>
                                                <th>PF Admin</th>
                                                <th>PF Edli</th>
                                                <th>Total PF Amount</th>
                                                <th width="15%">Link Challan No.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $employee_amt = $employer_amt = $pf_admin = $pf_edli = $final_total_amount = 0;
                                            if(!empty($tds_report)){
                                                $z=1;
                                                foreach($tds_report as $row){ 
                                                    $month = value_by_id("tblmonths", $row->month, "month_name");
                                                    $yearmonth = "<span>".$month." / ".$row->year."</span>";
                                                    $ttlamount = ($row->employee_contribution+$row->employer_contribution+$row->pf_admin+$row->pf_edli);
                                                    
                                                    $employee_amt += $row->employee_contribution;
                                                    $employer_amt += $row->employer_contribution;
                                                    $pf_admin += $row->pf_admin;
                                                    $pf_edli += $row->pf_edli;
                                                    $final_total_amount += $ttlamount;
                                            ?>                                                                                      
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo cc(get_employee_fullname($row->employee_id));  ?></td>
                                                        <td><?php echo $yearmonth; ?></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-info up_emp_deduction" data-rid="<?php echo $row->id; ?>" data-ftype="employee_contribution" data-fval="<?php echo $row->employee_contribution;?>"><?php echo $row->employee_contribution;?></a></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-info up_emp_deduction" data-rid="<?php echo $row->id; ?>" data-ftype="employer_contribution" data-fval="<?php echo $row->employer_contribution;?>"><?php echo $row->employer_contribution;?></a></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-info up_emp_deduction" data-rid="<?php echo $row->id; ?>" data-ftype="pf_admin" data-fval="<?php echo $row->pf_admin;?>"><?php echo $row->pf_admin;?></a></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-info up_emp_deduction" data-rid="<?php echo $row->id; ?>" data-ftype="pf_edli" data-fval="<?php echo $row->pf_edli;?>"><?php echo $row->pf_edli;?></a></td>
                                                        <td><?php echo number_format($ttlamount, '2'); ?></td>
                                                        <td>
                                                            <?php
                                                                if (!empty($row->challan_id) && $row->challan_id > 0){
                                                                    echo '<a href="javascript:void(0);"  class="btn-sm btn-success tdschallan_id" data-tdschallan_id="'.$row->challan_id.'" data-tds_id="'.$row->id.'" >'.value_by_id("tblemployee_pf_esic_challan", $row->challan_id, "challan_no").'</a>';
                                                                }else{
                                                                    echo '<a href="javascript:void(0);" data-tdschallan_id="0" data-tds_id="'.$row->id.'"  class="btn-sm btn-info tdschallan_id"><i class="fa fa-plus"></i> Link To Challan</a>';
                                                                }  
                                                            ?>
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
                                                <td></td>
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
<div id="updeduction_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("employees/update_pf_deduction"), array('id' => 'pf-form', 'class' => 'pf_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Employee Deduction</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="contribute_field" class="control-label contribute_field_text">Employee Contribution</label>
                            <input type="text" id="contribute_field_val" name="contribute_field_val" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="contribute_field_type" value="0" id="contribute_field_type">
                    <input type="hidden" name="pf_defuction_id" value="0" id="pf_defuction_id">
                    <input type="hidden" name="section" value="PF" id="section">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>


<div id="tdschallan_model" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("employees/addPFChallan"), array('id' => 'pfchallan-form', 'class' => 'tdschallan_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add PF Challan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="challan_id" class="control-label">PF Challan</label>
                                <select name="challan_id" class="form-control selectpicker" required='' data-live-search="true" id="tds_challanid">
                                    <option value=""></option>
                                    
                                </select>
                            </div>
                            <div class="form-group linktdschallan_div">
                                
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tds_id" value="0" id="tdsdeductionid">
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
    $("#year").on("change", function(){
        var year_id = $("#year").val();
        $.get("<?php echo admin_url("salary_new/getmonths?year_id="); ?>"+year_id, function(response){
            $("#month").html(response);
            $('.selectpicker').selectpicker('refresh');
        });
    });

    $(".up_emp_deduction").on("click", function(){

        $("#updeduction_modal").modal("show");
        var ftype = $(this).data("ftype");
        var fval = $(this).data("fval");
        var rid = $(this).data("rid");
        if (ftype == 'employee_contribution'){
            $(".contribute_field_text").html('Employee Contribution');
        }else if (ftype == 'employer_contribution'){
            $(".contribute_field_text").html('Employer Contribution');
        }else if (ftype == 'pf_admin'){
            $(".contribute_field_text").html('PF Admin');
        }else if (ftype == 'pf_edli'){
            $(".contribute_field_text").html('PF Edli');
        }
        $("#contribute_field_val").val(fval);
        $("#contribute_field_type").val(ftype);
        $("#pf_defuction_id").val(rid);
        
    });

    $('.tdschallan_id').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tdsdeductionid").val(tds_id);
        var challan_id = $(this).data("tdschallan_id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/employees/get_pf_challan'); ?>",
            data    : {'challan_id' : challan_id, 'tds_id' : tds_id},
            success : function(response){
                if(response != ''){
                    $("#tds_challanid").html(response);
                    $('.selectpicker').selectpicker('refresh');
                    $("#tdschallan_model").modal("show");
                }else{
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
        $(".linktdschallan_div").html('');
        if (challan_id > 0){
            var tchallanurl = '<?php echo admin_url("employees/view_pf_challan/"); ?>'+challan_id;
            tdschallanlink = '<a href="'+tchallanurl+'" target="_blank" class="btn-sm btn-info">View PF Challan</a>';
            $(".linktdschallan_div").html(tdschallanlink);
        }
        
    });
</script> 

</body>
</html>
