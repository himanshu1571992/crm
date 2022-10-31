
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
                                <a href="<?php echo admin_url('tds/tds_challan_list'); ?>" type="submit" class="btn btn-info">TDS Challan List </a>
                                <a href="<?php echo admin_url('tds/add_tds_deduction'); ?>" type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Add TDS Deduction</a>
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
                                    
                                    <div class="form-group col-md-3">
                                        <label for="type" class="control-label">Type</label>
                                        <select name="type" class="form-control selectpicker" data-live-search="true" id="type">
                                            <option value=""></option>
                                            <option value="0" <?php echo (isset($type) && strlen($type) > 0 && $type == '0') ? 'selected' : ''; ?>>Direct</option>
                                            <option value="1" <?php echo (isset($type) && $type == '1') ? 'selected' : ''; ?>>PO Payment</option>
                                            <option value="2" <?php echo (isset($type) && $type == '2') ? 'selected' : ''; ?>>Payment Request</option>
                                            <option value="3" <?php echo (isset($type) && $type == '3') ? 'selected' : ''; ?>>Employee Salary</option>
                                        </select>
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
                                                <th width="1%">S.No.</th>
                                                <th>Name of Party</th>
                                                <th>Type</th>                               
                                                <th width="10%">Paid Amount</th>                               
                                                <th width="10%">Taxable Amount</th>                               
                                                <th width="10%">TDS Amount</th>
                                                <th>Booking Date</th>
                                                <th>Date of Trasaction</th>
                                                <th>PAN No of Party</th>
                                                <th width="15%">TDS Section</th>
                                                <th width="30%">TDS Challan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($tds_report)){
                                                $z=1;
                                                foreach($tds_report as $row){ 
                                                    $date1=date_create(date("Y-m-d"));
                                                    $date2=date_create($row->date);
                                                    $diff=date_diff($date1, $date2);
                                                    $days = $diff->format("%a");
                                                    $newrowflag = '';
                                                    if ($days === '0'){
                                                        $newrowflag = '<span class="badge badge-secondary" style="background-color:red">New</span>';
                                                    }
                                                    $yearmonth = "";
                                                    if ($row->rel_type == "3"){
                                                        $salarylog = $this->db->query("SELECT month,year FROM tblsalarypaidlog WHERE id='".$row->rel_id."'")->row();
                                                        if (!empty($salarylog)){
                                                            $month = value_by_id("tblmonths", $salarylog->month, "month_name");
                                                            $yearmonth = "<br><span>(".$month."-".$salarylog->year.")</span>";
                                                        }
                                                    }
                                            ?>                                                                                      
                                                    <tr>
                                                        <td>
                                                            <?php echo $z++;?>
                                                        </td>
                                                        <td>
                                                            <?php echo get_creator_info($row->addedby, $row->created_at); ?>
                                                            <?php echo cc($row->party_name).' '.$newrowflag.$yearmonth;  ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if ($row->rel_type == '1'){
                                                                    echo '<span class="label label-success">PO Payment</span>';
                                                                }else if ($row->rel_type == '2'){
                                                                    echo '<span class="label label-info">Payment Request</span>';
                                                                }else if ($row->rel_type == '3'){
                                                                    echo '<span class="label label-warning">Employee Salary</span>';
                                                                }else{
                                                                    echo '<span class="label label-danger">Direct</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row->paid_amount;?></td>
                                                        <td><?php 
                                                            if (!empty($row->taxable_amount) && $row->taxable_amount > 0){
                                                                echo $row->taxable_amount;
                                                            }else{
                                                                echo '<a href="javascript:void(0);" data-target="#taxableamt_modal" data-tds_id="'.$row->id.'" data-toggle="modal" class="label label-info taxable_amt"><i class="fa fa-plus"></i> Add Amount</a>';
                                                            }
                                                        ?></td>
                                                        <td><?php echo $row->tds_amount;?></td>
                                                        <td>
                                                            <?php 
                                                                if ($row->rel_type == '1'){
                                                                    $chk_payment = $this->db->query("SELECT `po_id` FROM `tblpurchaseorderpayments` WHERE `id` ='".$row->rel_id."' ")->row();
                                                                    if (!empty($chk_payment)){
                                                                        $chk_invoice = $this->db->query("SELECT `date` FROM `tblpurchaseinvoice` WHERE `po_id` = '".$chk_payment->po_id."' ")->row();
                                                                        echo (!empty($chk_invoice)) ? _d($chk_invoice->date) : '<span class="label label-warning">Invoice Pending</span>';
                                                                    }else{
                                                                        echo '<span class="label label-warning">Invoice Pending</span>';
                                                                    }
                                                                }else{
                                                                    if (!empty($row->booking_date)){
                                                                        echo _d($row->booking_date);
                                                                    }else{
                                                                        echo '<a href="javascript:void(0);" data-target="#bookingdate_modal" data-tds_id="'.$row->id.'" data-toggle="modal" class="label label-info bookingdate"><i class="fa fa-plus"></i> Add Booking Date</a>';
                                                                    }
                                                                }     
                                                            ?>    
                                                        </td>
                                                        <td><?php echo _d($row->date);?></td>
                                                        <td>
                                                            <?php
                                                                if (!empty($row->pan_no)){
                                                                    echo $row->pan_no;
                                                                }else{
                                                                    echo '<a href="javascript:void(0);" data-target="#pancard_modal" data-tds_id="'.$row->id.'" data-toggle="modal" class="label label-info pencard_no"><i class="fa fa-plus"></i> Add Number</a>';
                                                                }
                                                                
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if (!empty($row->section_id) && $row->section_id > 0){
                                                                    echo '<a href="javascript:void(0);" data-target="#tdssection_model" data-toggle="modal" class="btn-sm btn-success tdssection_id" data-sectionid="'.$row->section_id.'" data-tds_id="'.$row->id.'" >'.value_by_id("tbltdssections", $row->section_id, "code").'</a>';
                                                                }else{
                                                                    echo '<a href="javascript:void(0);" data-target="#tdssection_model" data-toggle="modal" data-sectionid="0" data-tds_id="'.$row->id.'"  class="label label-info tdssection_id"><i class="fa fa-plus"></i> Add Section</a>';
                                                                }
                                                                
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($row->section_id > 0){
                                                                if (!empty($row->tds_challan_id) && $row->tds_challan_id > 0){
                                                                    echo '<a href="javascript:void(0);"  class="label label-success tdschallan_id" data-tdschallan_id="'.$row->tds_challan_id.'" data-tds_id="'.$row->id.'" >'.value_by_id("tbltdschallans", $row->tds_challan_id, "challan_no").'</a>';
                                                                }else{
                                                                    echo '<a href="javascript:void(0);" data-tdschallan_id="0" data-tds_id="'.$row->id.'"  class="label label-info tdschallan_id"><i class="fa fa-plus"></i> Link To Challan</a>';
                                                                }
                                                            }else{
                                                                $linkalert = "alert('Please add TDS section first')";
                                                                echo '<a href="javascript:void(0);" onclick="'.$linkalert.'" class="label label-info"><i class="fa fa-plus"></i> Link To Challan</a>';
                                                            }   
                                                            
                                                            if ($row->rel_type == 0){
                                                                echo '&nbsp;<a href="'.admin_url('tds/add_tds_deduction/'.$row->id).'" class="label label-info"><i class="fa fa-edit"></i></a>';
                                                            }
                                                            if ($row->section_id == 0 && $row->tds_challan_id == 0){
                                                                echo '&nbsp;<a href="'.admin_url('tds/delete_tds_deduction/'.$row->id).'" class="label label-danger _delete"><i class="fa fa-trash"></i></a>';
                                                            }
                                                            ?>
                                                        </td>
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
                </div>
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<!-- Modal -->
<div id="pancard_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("tds/addPanCardNumber"), array('id' => 'pancard-form', 'class' => 'pancard_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Pan No</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pan_no" class="control-label">Pan No</label>
                            <input type="text" id="pan_no" name="pan_no" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tds_id" value="0" id="tds_deduction_id">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="taxableamt_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("tds/addTaxableAmount"), array('id' => 'taxableamt-form', 'class' => 'taxableamt_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Taxable Amount</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="taxable_amount" class="control-label">Taxable Amount</label>
                            <input type="number" step="any" id="taxable_amount" name="taxable_amount" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tds_id" value="0" id="tdsdeductionrow_id">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="bookingdate_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("tds/addBookingdate"), array('id' => 'taxableamt-form', 'class' => 'taxableamt_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Booking Date</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" app-field-wrapper="date">
                                <label for="booking_date" class="control-label">Booking Date</label>
                                <div class="input-group date">
                                    <input id="booking_date" name="booking_date" class="form-control datepicker" aria-invalid="false" type="text" required=''><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tds_id" value="0" id="tds_deductionid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="tdssection_model" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("tds/addTdsSection"), array('id' => 'tds-form', 'class' => 'tds_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add TDS Section</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="section_of_tds" class="control-label">Section Of TDS</label>
                                <select name="section_id" class="form-control selectpicker" required='' data-live-search="true" id="section_of_tds">
                                    <option value=""></option>
                                    <?php 
                                        if (!empty($tds_section_list)){
                                            foreach ($tds_section_list as $value) {
                                                echo '<option value="'.$value->id.'">'.cc($value->name).'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tds_id" value="0" id="tdsdeduction_id">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="tdschallan_model" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url("tds/addTdsChallan"), array('id' => 'tdschallan-form', 'class' => 'tdschallan_form')); ?>                                    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add TDS Challan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tds_challan_id" class="control-label">TDS Challan</label>
                                <select name="tds_challan_id" class="form-control selectpicker" required='' data-live-search="true" id="tds_challanid">
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
    $('.pencard_no').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tds_deduction_id").val(tds_id);
    });
    $('.taxable_amt').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tdsdeductionrow_id").val(tds_id);
    });
    $('.bookingdate').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tds_deductionid").val(tds_id);
    });

    $('.tdssection_id').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tdsdeduction_id").val(tds_id);
        var sectionid = $(this).data("sectionid");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/tds/get_tds_sections'); ?>",
            data    : {'sectionid' : sectionid},
            success : function(response){
                if(response != ''){
                    $("#section_of_tds").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });

    $('.tdschallan_id').click(function(){
        var tds_id = $(this).data("tds_id");
        $("#tdsdeductionid").val(tds_id);
        var tdschallan_id = $(this).data("tdschallan_id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/tds/get_tds_challan'); ?>",
            data    : {'tdschallan_id' : tdschallan_id, 'tds_id' : tds_id},
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
        if (tdschallan_id > 0){
            var tchallanurl = '<?php echo admin_url("tds/view_tds_challan/"); ?>'+tdschallan_id;
            tdschallanlink = '<a href="'+tchallanurl+'" target="_blank" class="btn-sm btn-info">View TDS Challan</a>';
            $(".linktdschallan_div").html(tdschallanlink);
        }
        
    });
</script> 

</body>
</html>
