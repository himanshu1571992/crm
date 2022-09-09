<?php
$session_id = $this->session->userdata();

init_head();

?>
<style>
.dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}

.circle-blue {
    background-color: #03a9f4;
}
.circle-success {
    background-color: #84c529;
}
.circle-danger {
    background-color: #fc2d42;
}
.circle-warning {
    background-color: #f9d40e;
}
.dot > p {
  margin-top: 4px;
  color: #fff;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?><a href="<?php echo admin_url('leads/export_assign_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Export</a></h4>
                        <hr class="hr-panel-heading">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="branch_id" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" id="service_type" name="service_type">
                                            <option value="" disabled selected="">--Select One-</option>
                                            <option value="1" <?php echo (!empty($s_service_type) && $s_service_type == 1) ? 'selected' : ''; ?> >Rent</option>
                                            <option value="2" <?php echo (!empty($s_service_type) && $s_service_type == 2) ? 'selected' : ''; ?> >Sales</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php
                                        if (!empty($f_date)) {
                                            echo $f_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php
                                        if (!empty($t_date)) {
                                            echo $t_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php
                            if (is_admin() == 1) {
                        ?>
                            <div class="row" style="margin-top: 15px;">
                                <?php
                                $ttl_amount = 0;
                                if (!empty($lead_info)) {
                                    foreach ($lead_info as $lead) {
                                        $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '" . $lead->id . "' order by id desc  ")->row();
                                        if (!empty($quotation_info)) {
                                            $ttl_amount += $quotation_info->total;
                                        }
                                    }
                                    echo '<div class="col-md-4">
                                            <h4 style="color: red;">Total Amount : ' . $ttl_amount . '</h4>
                                            <h4 style="color: red;">Total Record : ' . count($lead_info) . '</h4>
                                        </div><br><br>';
                                }
                                ?>

                            </div>
                        <?php
                            }
                        ?>
                        <div>
                            <span class="dot circle-blue"></span> Total Outgoing Calls
                            <span class="dot circle-success"></span> Total Connecting Calls
                            <span class="dot circle-danger"></span> Total Missed Calls
                            <span class="dot circle-warning"></span> Total Activity
                        </div>
                        <br>
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
                                        <th>Amount</th>                                        
                                        <th>Sales Person</th>
                                        <th>Followup</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($lead_info)) {
                                        foreach ($lead_info as $key => $value) {

                                            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '" . $value->client_branch_id . "' ")->row();

                                            $assign_info = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '" . $value->id . "' ")->row();

                                            if ($value->client_branch_id > 0) {
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


                                            $outputType = '<div class="row"><div class="col-md-12 enquirymaintype'.$value->id.'"><span class="inline-block label label-' . (empty($maintype['color']) ? 'default': '') . '" style="color:' . $maintype['color'] . ';border:1px solid ' . $maintype['color'] . '">' . cc($maintype['name']);
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
                                            $outputType .= '</span></div><br><br>';

                                            $outputType .= '<div class="col-md-12 enquirytype'.$value->id.'"><span class="inline-block label label-' . (empty($type['color']) ? 'default': '') . '" style="color:' . $type['color'] . ';border:1px solid ' . $type['color'] . '">' . cc($type['name']);
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
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td>
                                                    <?php
                                                        echo '<a target="_blank" href="' . admin_url('leads/lead_profile/' . $value->id) . '"> LEAD-' . number_series($value->id) . '</a>';
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo cc($company);
                                                    echo '<br/>';
                                                    //echo $outputStatus;
                                                    echo $outputType;
                                                    ?></td>
                                                <td><?php echo $quotation; ?></td>                                            
                                                <td><?php echo _d($value->enquiry_date); ?></td> 
                                                <td><?php if (!empty($contact_info)) { ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/' . $value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a><?php
                                                } else {
                                                    echo '--';
                                                } cc(value_by_id('tblenquirytypemaster', $value->enquiry_type_id, 'name'));
                                                    ?></td>
                                                <td><?php echo value_by_id('tblleadssources', $value->source, 'name'); ?></td>
                                                <td><?php echo $amount; ?></td>
                                                <!-- <td>
                                                <?php
                                                if ($value->status == 1) {
                                                    echo '<button type="button" class="btn btn-info lead_process" style="width: 110px;" data-toggle="modal" data-target="#statusModal" value="' . $value->id . '">Qualified</button>';
                                                } else {
                                                    echo '<button class="btn btn-ganger" disabled="" style="width: 110px;">Unqualified</button>';
                                                }
                                                ?>       
            
                                                </td> -->

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
                                                <td class="text-center">

                                                    <?php
                                                        $client_text = ($value->client_branch_id > 0) ? 'Update Client' : 'Make Client';
                                                        $client_btn = ($value->client_branch_id > 0) ? 'btn-update' : 'btn-update';
                                                        $lead_count = get_lead_call_count($value->id);
                                                    ?>
                                                    <a href="<?php echo admin_url("leads/lead_contact/".$value->id); ?>" class="dot circle-blue"><p><?php echo $lead_count["ttl_calls"]; ?></p></a>
                                                    <a href="<?php echo admin_url("leads/lead_contact/".$value->id); ?>" class="dot circle-success"><p><?php echo $lead_count["ttlattend_calls"]; ?></p></a>
                                                    <a href="<?php echo admin_url("leads/lead_contact/".$value->id); ?>" class="dot circle-danger"><p><?php echo $lead_count["ttlmissed_calls"]; ?></p></a>
                                                    <a href="<?php echo admin_url("follow_up/lead_activity/".$value->id); ?>" class="dot circle-warning"><p><?php echo $lead_count["ttlactivity"]; ?></p></a>
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php if (check_permission_page(3, 'edit')) { ?>
                                                                    <a href="<?php echo admin_url('leads/leads/' . $value->id); ?>" class="" title="Edit">Edit</a>

                                                                <?php
                                                                }
                                                                if (!empty($contact_info)) {
                                                                    ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/' . $value->id); ?>">Lead Contact</a><?php
                                                                }
                                                                echo '<a target="_blank" class="" href="' . admin_url('follow_up/lead_activity/' . $value->id) . '" title="Active">Activity</a>';
                                                                echo '<button type="button" class="' . $client_btn . ' update_client" data-toggle="modal" data-target="#clientModal" value="' . $value->id . '">' . $client_text . '</button>';


                                                                if (check_permission_page(3, 'delete')) {
                                                                    ?>
                                                                    <a href="<?php echo admin_url('leads/delete/' . $value->id); ?>" class="_delete" title="Delete">Delete</a>
        <?php } ?>
                                                                <a href="javascript:void(0);" class="btn-with-tooltip lead-email" data-id="<?php echo $value->id; ?>"  data-target="#lead_send_to_customer" id="send_mail" data-toggle="modal">
                                                                    <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Send to Email" data-placement="bottom" data-original-title="" title="">Send to Email</span>
                                                                </a>
        <?php if ($value->process_id < 6) { ?>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip lost-leads btn btn-danger" data-id="<?php echo $value->id; ?>"  data-target="#lead_lost" id="lost_lead_remark" data-toggle="modal">
                                                                        <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Lost Lead" data-placement="bottom" data-original-title="" title="">Lost Lead</span>
                                                                    </a>
                                            <?php } ?>
                                                            </li>
                                                        </ul>
                                                    </div>
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
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_type', data).done(function (response) {
            if (response != ""){
                $(".enquirytype"+lead_id).html(response);
            }
//            location.reload(true);
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
</script>




</html>

