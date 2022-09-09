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
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" action="">
                                <div class="row">
                                    
                                    <div class="form-group col-md-4">
                                        <label for="Existing Client" class="control-label">Existing Client</label>
                                        <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                            <option value="" disabled selected ></option>
                                            <?php
                                            if(!empty($client_list)){
                                                foreach ($client_list as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->userid; ?>" <?php if(!empty($client_id) && $client_id == $value->userid){ echo 'selected';} ?>><?php echo cc($value->client_branch_name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="customer_company" class="control-label">Customer or Company Name </label>
                                        <input type="text" name="customer_company" class="form-control" value="<?php if (!empty($customer_company)) { echo $customer_company;} ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="lead_no" class="control-label">Lead No.</label>
                                        <input type="text" name="lead_no" class="form-control" value="<?php if(!empty($lead_no)){ echo $lead_no; } ?>">
                                    </div>
                                    <div class="form-group col-md-4" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">                            
                                        <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Lead #</th>
                                            <th>Customer Name</th>
                                            <th>Quotation</th>
                                            <th>Enq date</th>
                                            <th>Contacts</th>
                                            <th>Source</th>                                        
                                            <th>Sales Person</th>
                                            <th>Followup</th>
                                            <th>Status</th>                                       
                                            <th>Amount</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $ttl_amount = 0;
                                        $i = 0;
                                        if (!empty($lead_info)) {
                                            foreach ($lead_info as $key => $value) {

                                                $chk_activity = $this->db->query("SELECT `date` FROM tblfollowupleadactivity WHERE lead_id = '".$value->id."' ORDER BY id DESC LIMIT 1")->row();
                                                $activiy_date = (!empty($chk_activity)) ? $chk_activity->date : $value->enquiry_date;
                                                
                                                if ($activiy_date <= date('Y-m-d', strtotime("-7 days"))){

                                                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '" . $value->client_branch_id . "' ")->row();

                                                    $assign_info = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '" . $value->id . "' ")->row();
                                                    
                                                    if ($value->client_branch_id > 0 && !empty($client_info)) {
                                                        $company = $client_info->client_branch_name;
                                                    } else {
                                                        $company = $value->company;
                                                    }
                                                    
                                                    if (check_quotation($value->id) == 1) {
                                                        $quotation = 'Yes';
                                                    } else {
                                                        $quotation = 'No';
                                                    }

                                                    $checked = ($value->followup == 1 ) ? 'checked' : '';
                                                    $toggleActive = '<div class="onoffswitch">
                                                                        <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                                                                        <label class="onoffswitch-label" for="' . $value->id . '"></label>
                                                                    </div>';

                                                    $contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '" . $value->id . "' and c.phonenumber != '' ")->row();

                                                    //getting last quotation amount
                                                    $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '" . $value->id . "' order by id desc  ")->row();
                                                    if (!empty($quotation_info)) {
                                                        $amount = $quotation_info->total;
                                                    } else {
                                                        $amount = '0.00';
                                                    }

                                                    $status = $this->db->query("SELECT * from `tblleadsstatus` where id = '" . $value->status . "' ")->row_array();
                                                    $type = $this->db->query("SELECT * from `tblenquirytypemaster` where id = '" . $value->enquiry_type_id . "' ")->row_array();
                                                    $maintype = $this->db->query("SELECT * from `tblmainenquirytypemaster` where id = '".$value->enquiry_type_main_id."' ")->row_array();
                                                    if ($value->enquiry_type_main_id > 0){
                                                        $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where enquiry_type_main_id = ".$value->enquiry_type_main_id." AND status = 1 ")->result();
                                                    }else{
                                                        $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ")->result();
                                                    }
                                                    $outputType = '<div class="col-md-12 row"><div class=" enquirymaintype'.$value->id.'"><span class="inline-block label label-' . (empty($maintype['color']) ? 'default': '') . '" style="color:' . $maintype['color'] . ';border:1px solid ' . $maintype['color'] . '">' . cc($maintype['name']);
                                                    $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                                    $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tablemainLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                    $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                                    $outputType .= '</a>';

                                                    $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tablemainLeadsStatus-' . $value->id . '">';
                                                    foreach ($mainleadtype_info as $mainleadChangeType) {
                                                        if ($value->enquiry_type_main_id != $mainleadChangeType->id) {
                                                            $outputType .= '<li>
                                                        <a href="#" onclick="change_lead_main_status('.$value->enquiry_type_main_id.',' . $mainleadChangeType->id . ',' . $value->id . '); return false;">
                                                            ' . cc($mainleadChangeType->name) . '
                                                        </a>
                                                    </li>';
                                                        }
                                                    }
                                                    $outputType .= '</ul>';
                                                    $outputType .= '</div>';
                                                    $outputType .= '</span></div><br>';

                                                    $outputType .= '<div class=" enquirytype'.$value->id.'"><span class="inline-block label label-' . (empty($type['color']) ? 'default': '') . '" style="color:' . $type['color'] . ';border:1px solid ' . $type['color'] . '">' . cc($type['name']);
                                                    $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                                    $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                    $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                                    $outputType .= '</a>';

                                                    $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $value->id . '">';
                                                    foreach ($leadtype_info as $leadChangeType) {
                                                        if ($value->enquiry_type_id != $leadChangeType->id) {
                                                            $outputType .= '<li>
                                                        <a href="#" onclick="change_lead_type('.$value->enquiry_type_id.',' . $leadChangeType->id . ',' . $value->id . '); return false;">
                                                            ' . cc($leadChangeType->name) . '
                                                        </a>
                                                    </li>';
                                                        }
                                                    }
                                                    $outputType .= '</ul>';
                                                    $outputType .= '</div>';
                                                    $outputType .= '</span></div></div>';
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
                                                            echo '<br/>';
                                                            echo $outputType;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $quotation; ?></td>                                            
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
                                                    <td><?php
                                                        if (!empty($assign_info)) {
                                                            echo '<a target="_blank" href="' . admin_url('staff/member/' . $assign_info->staff_id) . '">' . get_employee_name($assign_info->staff_id) . '</a>';
                                                        } else {
                                                            echo '--';
                                                        }
                                                        ?></td>
                                                    <td><?php echo $toggleActive; ?></td>
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
                                            }
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10"><h4>Total Amount</h4></td>
                                            <td><h4><?php echo number_format($ttl_amount, 2, '.',','); ?></h4></td>
                                        </tr>
                                    </tfoot>

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





<script>



    $(document).ready(function () {

        $('#newtable').DataTable({
            "iDisplayLength": 15,
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
<script type="text/javascript">
    function change_lead_type(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_type', data).done(function(response) {
            if (response != ""){
                $(".enquirytype"+lead_id).html(response);
            }
//        location.reload(true);
    });
}
function change_lead_main_status(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_main_status', data).done(function(response) {
            
            if (response != ""){
                var obj = jQuery.parseJSON(response);
                $(".enquirymaintype"+lead_id).html(obj["main_status"]);
                $(".enquirytype"+lead_id).html(obj["sub_status"]);
            }
//        location.reload(true);
    });
}

//$("#staff_id").on("change", function(){
//    var val = $(this).val();
//    if (val == "all"){
//        $('#staff_id').attr("multiple", "");
//        $('#staff_id option').attr("selected", "selected");
//    }
//});
</script>




</html>

