
<?php init_head();



?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />

<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12" align="center">
                                            <span style="color: red;font-size:20px;">Total Employee Expense Amount : </span><span style="color: red;font-size:20px;" class="ttlamount_div">0.00</span>
                                        </div>
                                        <div class="col-md-12" align="center">
                                            <span style="color: red;font-size:20px;">Total System Expense Amount : </span><span style="color: red;font-size:20px;" class="ttlsystemamount_div">0.00</span>
                                        </div>
                                        <div class="col-md-12" align="center">
                                            <span style="color: red;font-size:20px;">Over All : </span><span style="color: red;font-size:20px;" class="ttloverall_div">0.00</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($section == 1) ? 'active':''; ?>">
                                            <a href="#employee_expense_report" aria-controls="employee_expense_report" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="true">Employee Expense Report</a>
                                        </li>
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($section == 2) ? 'active':''; ?>">
                                            <a href="#system_expense_report" aria-controls="system_expense_report" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="false">System Expense Report</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane <?php echo ($section == 1) ? 'active':''; ?>" id="employee_expense_report">
                                            <div class="col-md-12">
                                                <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-3" app-field-wrapper="date">
                                                            <label for="date" class="control-label">From Date</label>
                                                            <div class="input-group date">
                                                                <input id="date" name="f_date" class="form-control datepicker" value="<?php echo (isset($f_date) && !empty($f_date)) ? date("d/m/Y", strtotime($f_date)) : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3" app-field-wrapper="date">
                                                            <label for="date" class="control-label">To Date</label>
                                                            <div class="input-group date">
                                                                <input id="date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_date) && !empty($s_date)) ? date("d/m/Y", strtotime($s_date)) : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="expense_head" class="control-label">Expense Head</label>
                                                            <select class="form-control selectpicker" name="expense_head_id" id="head_id" data-live-search="true">
                                                                <option value=""></option>
                                                                <?php 
                                                                    if (!empty($expense_head_list)){
                                                                        foreach($expense_head_list as $head){
                                                                ?>
                                                                            <option value="<?php echo $head->id; ?>" <?php echo (isset($expense_head_id) && $expense_head_id == $head->id) ? 'selected':''; ?>><?php echo $head->name; ?></option>
                                                                <?php            
                                                                        }
                                                                    }    
                                                                ?>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="hidden" class="sectiontype" name="section" value="1">
                                                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                                            <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                                        </div>
                                                    </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="newtable">
                                                        <thead>
                                                            <tr>
                                                                <th align="center" width="1px;">Sr.No</th>
                                                                <th align="center">Heads</th>
                                                                <th align="center">Sub Types</th>
                                                                <th align="center">Total</th>
                                                                <?php 
                                                                    $pno = "0,1,2";
                                                                    $p = 2;
                                                                    if (!empty($employeesname_list)){
                                                                        foreach ($employeesname_list as $val) {
                                                                            $employee_info = get_employee_info($val->addedfrom);

                                                                            $pno .= ",".++$p; 
                                                                            echo '<th align="center">'.get_employee_fullname($val->addedfrom).' <br>('.value_by_id('tbldesignation',$employee_info->designation_id,'designation').')</th>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </tr>
                                                        </thead>  
                                                        <tbody>
                                                            <?php
                                                                $i = 0;
                                                                $ttlamount = 0;
                                                                $ttlemp_div = "";
                                                                if (!empty($subtypeslist)){
                                                                    foreach ($subtypeslist as $key => $value) {
                                                                        $head_id = value_by_id('tblexpensetype',$value->type_id,'head_id');
                                                                        $showrow = 1; 
                                                                        if (isset($expense_head_id)){
                                                                            $showrow = 0; 
                                                                            if ($expense_head_id == $head_id){
                                                                                $showrow = 1; 
                                                                            }
                                                                        }

                                                                        if ($showrow == 1){
                                                                        
                                                                            $headname = ($head_id > 0) ? cc(value_by_id('tblexpensehead',$head_id,'name')) : '--';
                                                                            $ttltotalcost = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblexpenses` WHERE `date` between '".$f_date."' AND '".$s_date."' AND `approved_status` = 1 AND `typesub_id` = '".$value->id."'")->row()->ttl_amt;
                                                                            $ttlamount += $ttltotalcost;

                                                                        
                                                            ?>
                                                                        <tr>
                                                                            <td align="center"><?php echo ++$i; ?></td>
                                                                            <td align="center"><?php echo $headname; ?></td>
                                                                            <td align="center"><?php echo cc($value->name); ?></td>
                                                                            <td align="center"><?php echo $ttltotalcost; ?></td>
                                                                            <?php 
                                                                                
                                                                                if (!empty($employeesname_list)){
                                                                                    foreach ($employeesname_list as $val) {
                                                                                        $ttlempcost = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblexpenses` WHERE `date` between '".$f_date."' AND '".$s_date."' AND `approved_status` = 1 and `typesub_id` = '".$value->id."' and `addedfrom` = '".$val->addedfrom."' ")->row()->ttl_amt;
                                                                                        if ($ttlempcost > 0){
                                                                                            $adminurl = admin_url('sales_report/getEmployeeExpenses?employee_id='.$val->addedfrom.'&subtypeid='.$value->id.'&from_date='.$f_date.'&to_date='.$s_date);
                                                                                            echo '<td align="center"><a href="'.$adminurl.'" target="_black" class="btn-sm btn-success expensediv" >'.$ttlempcost.'</a></td>';
                                                                                        }else{
                                                                                            echo '<td align="center">'.$ttlempcost.'</td>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </tr>
                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3" class="text-center"><h4>Total</h4></td>
                                                                <td class="text-center"><h4><?php echo number_format($ttlamount, 2, '.', ','); ?></h4></td>
                                                                <?php 
                                                                    $ttlamt = 0;
                                                                    if (!empty($employeesname_list)){
                                                                        foreach ($employeesname_list as $val) {
                                                                            $ttlamt = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblexpenses` WHERE `date` between '".$f_date."' AND '".$s_date."' AND `approved_status` = 1 and `typesub_id` > 0 and `addedfrom` = '".$val->addedfrom."' ")->row()->ttl_amt;
                                                                            echo '<td class="text-center"><h4>'.number_format($ttlamt, 2, '.', ',').'</h4></td>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </tr>
                                                        </tfoot>  
                                                    </table>   
                                                </div>     
                                            </div>     
                                        </div>    
                                        <div role="tabpanel" class="tab-pane <?php echo ($section == 2) ? 'active':''; ?>" id="system_expense_report">
                                            <div class="col-md-12">
                                                <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-3" app-field-wrapper="date">
                                                            <label for="date" class="control-label">From Date</label>
                                                            <div class="input-group date">
                                                                <input id="date" name="f_date" class="form-control datepicker" value="<?php echo (isset($f_date) && !empty($f_date)) ? date("d/m/Y", strtotime($f_date)) : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3" app-field-wrapper="date">
                                                            <label for="date" class="control-label">To Date</label>
                                                            <div class="input-group date">
                                                                <input id="date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_date) && !empty($s_date)) ? date("d/m/Y", strtotime($s_date)) : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="expense_head" class="control-label">Category</label>
                                                            <select class="form-control selectpicker" name="category_id" id="category_id" data-live-search="true">
                                                                <option value=""></option>
                                                                <?php 
                                                                    if (!empty($category_list)){
                                                                        foreach($category_list as $category){
                                                                ?>
                                                                            <option value="<?php echo $category->id; ?>" <?php echo (isset($category_id) && $category_id == $category->id) ? 'selected':''; ?>><?php echo $category->name; ?></option>
                                                                <?php            
                                                                        }
                                                                    }    
                                                                ?>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="hidden" class="sectiontype" name="section" value="2">
                                                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                                            <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                                        </div>
                                                    </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="newtable1">
                                                        <thead>
                                                            <tr>
                                                                <th align="center" width="1px;">Sr.No</th>
                                                                <th align="center">Category</th>
                                                                <th align="center">Head</th>
                                                                <th align="center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $j = 0;
                                                                $ttlsystemamount = 0;
                                                                if (!empty($headslist)){
                                                                    foreach ($headslist as $key => $value) {
                                                                        $ttltotalcost = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblpaymentrequest` WHERE `created_at` between '".$f_date."' AND '".$s_date."' AND `approved_status` = 1 AND `payfile_done` = 1 AND `head_id` = '".$value->id."'")->row()->ttl_amt;
                                                                        $ttlsystemamount += $ttltotalcost;
                                                            ?>
                                                                        <tr>
                                                                            <td align="center"><?php echo ++$j; ?></td>
                                                                            <td align="center"><?php echo cc(value_by_id('tblcompanyexpensecatergory',$value->category_id,'name')); ?></td>
                                                                            <td align="center"><?php echo cc($value->name); ?></td>
                                                                            <td align="center">
                                                                                <?php 
                                                                                    if ($ttltotalcost > 0){
                                                                                        $adminurl = admin_url('sales_report/getSystemExpenses?head_id='.$value->id.'&from_date='.$f_date.'&to_date='.$s_date);
                                                                                        echo '<a href="'.$adminurl.'" target="_black" class="btn-sm btn-success">'.$ttltotalcost.'</a>';
                                                                                    }else{
                                                                                        echo $ttltotalcost;
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
                                                                <td colspan="3" class="text-center"><h4>Total</h4></td>
                                                                <td class="text-center"><h4><?php echo number_format($ttltotalcost, 2, '.', ','); ?></h4></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>    
                                                </div>                 
                                            </div>
                                               
                                        </div>    
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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
     <script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>

<script>

$(document).ready(function() {
    $(".ttlamount_div").html('<?php echo number_format($ttlamount, 2, '.', ','); ?>');
    $(".ttlsystemamount_div").html('<?php echo number_format($ttlsystemamount, 2, '.', ','); ?>');
    $(".ttloverall_div").html('<?php echo number_format($ttlamount+$ttlsystemamount, 2, '.', ','); ?>');
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis',
        ]
    } );
    $('#newtable1').DataTable( {

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
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis',
        ]
    } );

    
} );

</script>

</body>
</html>
