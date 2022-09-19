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
</style>
<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?></h4>



                        <hr class="hr-panel-heading">

                        <form method="post" enctype="multipart/form-data" action="">

                            <div class="row">

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($fdate) && $fdate != "") ? $fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($tdate) && $tdate != "") ? $tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Branch State</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="branch_state" name="branch_state[]">
                                        <option value="" ></option>
                                        <?php 
                                        foreach ($state_list as $value) {
                                            $selected = (isset($branch_state) && in_array($value->id, $branch_state)) ? 'selected' : "";
                                            echo '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Type</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="type" name="type[]">
                                        <option value="" ></option>
                                        <option value="RI" <?php echo (isset($type) && in_array("RI", $type)) ? 'selected' : ""; ?>>Rent Invoice</option>
                                        <option value="SI" <?php echo (isset($type) && in_array("SI", $type)) ? 'selected' : ""; ?>>Sales Invoice</option>
                                        <option value="DN" <?php echo (isset($type) && in_array("DN", $type)) ? 'selected' : ""; ?>>DN (Damage)</option>
                                        <option value="DNP" <?php echo (isset($type) && in_array("DNP", $type)) ? 'selected' : ""; ?>>DN (Delay In Payment)</option>
                                        <option value="CN" <?php echo (isset($type) && in_array("CN", $type)) ? 'selected' : ""; ?>>Credit Note (CN)</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label">Client</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="client" name="client[]">
                                        <option value="" ></option>
                                        <?php 
                                        foreach ($client_list as $value) {
                                            $selected = (isset($clientid) && in_array($value->userid, $clientid)) ? 'selected' : "";
                                            echo '<option value="'.$value->userid.'" '.$selected.'>'.$value->client_branch_name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">  
                                
                                <div class="form-group col-md-2">
                                    <label for="month" class="control-label">GSTR1</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="gstr1_month" name="gstr1_month[]">
                                        <option value=""></option>
                                        <option value="notset" <?php echo (isset($gstr1_month) && in_array("notset", $gstr1_month)) ? 'selected' : ""; ?>>Not Set</option>
                                        <?php
                                        if (!empty($month_info)) {
                                            foreach ($month_info as $row) {
                                                $selected = (isset($gstr1_month) && in_array($row->id, $gstr1_month)) ? 'selected' : "";
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo $selected; ?>  ><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="month" class="control-label">GSTR3B</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="gstr3b_month" name="gstr3b_month[]">
                                        <option value=""></option>
                                        <option value="notset" <?php echo (isset($gstr3b_month) && in_array("notset", $gstr3b_month)) ? 'selected' : ""; ?>>Not Set</option>
                                        <?php
                                        if (!empty($month_info)) {
                                            foreach ($month_info as $row) {
                                                $selected = (isset($gstr3b_month) && in_array($row->id, $gstr3b_month)) ? 'selected' : "";
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo $selected; ?>  ><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="month" class="control-label">Tally</label>
                                    <select class="form-control selectpicker" multiple="" data-live-search="true" id="tally_month" name="tally_month[]">
                                        <option value=""></option>
                                        <option value="notset" <?php echo (isset($tally_month) && in_array("notset", $tally_month)) ? 'selected' : ""; ?>>Not Set</option>
                                        <?php
                                        if (!empty($month_info)) {
                                            foreach ($month_info as $row) {
                                                $selected = (isset($tally_month) && in_array($row->id, $tally_month)) ? 'selected' : "";
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo $selected; ?>  ><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
<!--                                <div class="form-group col-md-3">
                                    <label for="gst_type" class="control-label">GST Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="gsttype" name="gsttype">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($gsttype) && $gsttype == 1) ? 'selected' : ""; ?>>GSTR1</option>
                                        <option value="2" <?php echo (!empty($gsttype) && $gsttype == 2) ? 'selected' : ""; ?>>GSTR3B</option>
                                        <option value="3" <?php echo (!empty($gsttype) && $gsttype == 3) ? 'selected' : ""; ?>>Tally</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="month" class="control-label">Month</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="month" name="month">
                                        <option value=""></option>
                                        <?php
                                        if (!empty($month_info)) {
                                            foreach ($month_info as $row) {
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo (!empty($month) && $month == $row->id) ? 'selected' : ""; ?>  ><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>-->
                                <div class="form-group col-md-2">
                                    <label for="year" class="control-label">Year</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="year" name="year">
                                        <option value=""></option>
                                        <?php
                                        $j = date('Y');
                                        for ($i = 2017; $i <= $j; $i++) {
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php echo (!empty($year) && $year == $i) ? 'selected' : ""; ?>  ><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>

                        </form>

                        <br>
                        
                        <div class="col-md-12"> 
                            <?php
                            if (is_admin() == 1) {
                                ?>
                                <div class="row">
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Taxable Value</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format(($total_taxable_value), 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total SGST</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format(($totalsgst), 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total CGST</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format(($totalcgst), 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total IGST</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format(($totaligst), 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format($total_amt, 2, '.', ''); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                    <p style="color: red; text-align: center;"><?php echo count($clienttax_report); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <?php
                            }
                            ?>  

                            <hr> 
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#" class="btn btn-primary pull-right" id="take_action" data-target="#client_chkbox1" data-toggle="modal">Take Action</a>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th align="center">Branch State</th>
                                            <th align="center">Branch GST NO</th>
                                            <th align="center">Type</th>
                                            <th align="center" >Client Name</th>
                                            <th align="center">Client GST Number</th>
                                            <th align="center">Invoice Number</th>
                                            <th align="center">Invoice Date</th>
                                            <th align="center">Total Invoice Value</th>
                                            <th align="center">Total Taxable Value</th>
                                            <th align="center">CGST</th>
                                            <th align="center">SGST</th>
                                            <th align="center">IGST</th>
                                            <th align="center">CRM</th>
                                            <th align="center">GSTR1</th>
                                            <th align="center">GSTR3B</th>
                                            <th align="center">Tally</th>
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="ui-sortable">

                                        <?php
                                        $i = 1;

                                        if (!empty($clienttax_report)) {

                                            foreach ($clienttax_report as $key => $row) {
                                                $client_data = client_info($row["client_id"]);
                                                $ctype = ($client_data->company_branch == 1) ? "(I) ": "";
                                                $id = $row["id"];
                                                $rtype = $row["rtype"];
                                                $sign = ($row["type"] == "CN") ? " - ":"";
                                                
                                                $client_gst_number = ($row["client_gst_number"]) ? $row["client_gst_number"] : "--";
                                                $igst = ($row["igst"] > 0) ? $sign.$row["igst"] : $row["igst"];
                                                $sgst = ($row["sgst"] > 0) ? $sign.$row["sgst"] : $row["sgst"];
                                                $cgst = ($row["cgst"] > 0) ? $sign.$row["cgst"] : $row["cgst"];
                                                $output = "<tr>";
                                                $output .= "<td>".++$key."</td>";
                                                $output .= "<td>".value_by_id("tblstates", $row["branch_state_id"], "name")."</td>";
                                                $output .= "<td>".$row["branch_gst_no"]."</td>";
                                                $output .= "<td>".$ctype.$row["type"]."</td>";
                                                $output .= "<td>".$row["client_name"]."</td>";
                                                $output .= "<td>".$client_gst_number."</td>";
                                                $output .= "<td>".$row["invoice_number"]."</td>";
                                                $output .= "<td>".$row["invoice_date"]."</td>";
                                                $output .= "<td>".$sign.$row["total_invoice_value"]."</td>";
                                                $output .= "<td>".$sign.number_format($row["total_taxable_value"], 2, '.', '')."</td>";
                                                $output .= "<td>".$cgst."</td>";
                                                $output .= "<td>".$sgst."</td>";
                                                $output .= "<td>".$igst."</td>";
                                                $output .= "<td>".$row["crm"]."</td>";
                                                $output .= "<td>".$row["gstr1"]."</td>";
                                                $output .= "<td>".$row["gstr3b"]."</td>";
                                                $output .= "<td>".$row["tally"]."</td>";
                                                $output .= "<td><input type='checkbox' class='chkaction' data-did='".$id."' data-dtype='".$rtype."' name='ch_box'></td>";
                                                $output .= "</tr>";

                                                echo $output;
                                                
                                        ?>
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

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

<?php init_tail(); ?>

    <div id="client_chkbox" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <?php
            $attributes = array('id' => 'sub_form_product');
            echo form_open(admin_url("report/addclienttax"), $attributes);
            ?>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Client Tax </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="document_id" class="document_id" value="">
                    <input type="hidden" name="document_type" class="document_type" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gst_type" class="control-label">GST Type</label>
                                <select class="form-control selectpicker" required="" multiple="" data-live-search="true" id="gsttype" name="gsttype[]">
                                    <option value=""></option>
                                    <option value="1">GSTR1</option>
                                    <option value="2">GSTR3B</option>
                                    <option value="3">Tally</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gst_type" class="control-label">Assign To</label>
                                <select class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]" required="">
                                    <option>Select</option>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="year" class="control-label">Year</label>
                                <select class="form-control selectpicker" required="" data-live-search="true" id="year" name="year">
                                    <option value=""></option>
                                    <?php
                                    $j = date('Y');
                                    for ($i = 2017; $i <= $j; $i++) {
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo (!empty($year) && $year == $i) ? 'selected' : ""; ?>  ><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="month" class="control-label">Month</label>
                                <select class="form-control selectpicker" required="" data-live-search="true" id="month" name="month">
                                    <option value=""></option>
                                    <?php
                                    if (!empty($month_info)) {
                                        foreach ($month_info as $row) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>" <?php echo (!empty($month) && $month == $row->id) ? 'selected' : ""; ?>  ><?php echo $row->month_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                    <button type="submit" autocomplete="off"  class="btn btn-info">Save</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

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



    $(document).ready(function () {

//        $("#month").removeAttr("required", "");
        $("#year").removeAttr("required", "");
        
        $('#newtable').DataTable({
            "iDisplayLength": 25,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']

            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'

                    }

                },
                'colvis',
            ]

        });

    });

</script>
</html>

<script type="text/javascript">
    $(document).on('click', '#take_action', function () {
        
        var document_id = [];
        var document_type = [];
        $('.chkaction').each(function() {
            if (this.checked){
                var doc_id = $(this).data("did");
                var dtype = $(this).data("dtype");
                document_id.push(doc_id);
                document_type.push(dtype);
            }
        });
        if (document_id != ""){
            $('#client_chkbox').modal({
                show: 'false'
            }); 
            
            $(".document_id").val(document_id);
            $(".document_type").val(document_type);
        }else{
            alert("Please check at least one report");
        }
    });
    
//    $(document).on("change", "#gsttype", function(){
//        var gst_val = $(this).val();
//        if (gst_val != ""){
////            $("#month").attr("required", "");
//            $("#year").attr("required", "");
//        }
//    });
    $(document).on("change", "#gstr1_month", function(){
        var gst_val = $(this).val();
        if (gst_val != ""){
//            $("#month").attr("required", "");
            $("#year").attr("required", "");
        }
    });
    $(document).on("change", "#gstr3b_month", function(){
        var gst_val = $(this).val();
        if (gst_val != ""){
//            $("#month").attr("required", "");
            $("#year").attr("required", "");
        }
    });
    $(document).on("change", "#tally_month", function(){
        var gst_val = $(this).val();
        if (gst_val != ""){
//            $("#month").attr("required", "");
            $("#year").attr("required", "");
        }
    });
    
    
</script>