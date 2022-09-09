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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form', 'onsubmit' => "return confirm('Do you really want to perform mark attendance action?');")); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Mark Attendance </h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="date" class="control-label"><?php echo 'Date'; ?></label>
                                <div class="input-group date">
                                    <input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($s_date) && $s_date != "") ? $s_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">																

                                <?php
                                $t=0;
                                if (!empty($staff_list)) {
                                    
                                ?>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($page == "taxable") ? "active" : ""; ?>">
                                            <a href="#taxable" aria-controls="taxable" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="true">Taxable</a>
                                        </li>
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($page == "nontaxable") ? "active" : ""; ?>">
                                            <a href="#nontaxable" aria-controls="nontaxable" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="false">Non Taxable</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane <?php echo ($page == "taxable") ? "active" : ""; ?>" id="taxable">
                                            <?php
                                            foreach ($staff_list["taxable"] as $bid => $staff_data) {
                                                
                                                $info = $this->db->query("SELECT comp_branch_name FROM `tblcompanybranch` where id = '" . $bid . "' ")->row();
                                                if (!empty($staff_data)) {
                                                    echo '<tr><h3 align="center" class="text-danger">' . $info->comp_branch_name . '</h3></tr><hr>';
                                                    ?>
                                                    <div class="table-responsive">                                                    
                                                        <table class="display" id="">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Employee Name</th>
                                                                    <th>Start Hour</th>
                                                                    <th>End Hour</th>
                                                                    <th>Marked at</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($staff_data as $k => $staff) {
                                                                    ++$t;
                                                                    $record = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$att_date), '');

																	
                                                                    ?>


                                                                    <tr>
                                                                        <td><?php echo ++$k; ?><input type="hidden" name="staff_id[]" value="<?php echo $staff->staffid;?>"></td>
                                                                        <td>
                                                                            <?php
                                                                            if(!empty($record)){
                                                                    ?>
                                                                    <input type="hidden" value="<?php echo $record->approved_by; ?>" name="approved_by_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="<?php echo $record->updated_at; ?>" name="updated_at_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="<?php echo $record->marked_at; ?>" name="marked_at_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="<?php echo $record->by_biomax; ?>" name="by_biomax_<?php echo $staff->staffid; ?>">
                                                                    <?php    
                                                                    }else{
                                                                    ?>
                                                                    <input type="hidden" value="0" name="approved_by_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="" name="updated_at_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="" name="marked_at_<?php echo $staff->staffid; ?>">
                                                                    <input type="hidden" value="0" name="by_biomax_<?php echo $staff->staffid; ?>">
                                                                    <?php    
                                                                    }
                                                                            ?>

                                                                            <?php echo $staff->firstname;?></td>
                                                                        <td>
                                                                            <select class="form-control" disabled required="" id="working_from_<?php echo $staff->staffid; ?>" name="working_from_<?php echo $staff->staffid; ?>" data-live-search="true">
                                                                                <option value="" disabled selected>--Select One--</option>
                                                                                <?php
                                                                                for($hours=0; $hours<24; $hours++){
                                                                                    for($mins=0; $mins<60; $mins+=30){
                                                                                        $value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                                                                        ?>
                                                                                        <option value="<?php echo $value ?>" <?php echo (isset($staff->working_from) && $staff->working_from == $value) ? 'selected' : "" ?>><?php echo $value ?></option>
                                                                                        <?php
                                                                                    }
                                                                                } 
                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select class="form-control" disabled required="" id="working_to_<?php echo $t; ?>" name="working_to_<?php echo $staff->staffid; ?>"  data-live-search="true">
                                                                                <option value="" disabled selected>--Select One--</option>
                                                                                <?php
                                                                                for($hours=0; $hours<24; $hours++){
                                                                                    for($mins=0; $mins<60; $mins+=30){
                                                                                        $value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                                                                        ?>
                                                                                        <option value="<?php echo $value ?>" <?php echo (isset($staff->working_to) && $staff->working_to == $value) ? 'selected' : "" ?>  <?php if(!empty($record->working_to) && $record->working_to == $value){ echo 'selected';}?>><?php echo $value ?></option>
                                                                                        <?php
                                                                                    }
                                                                                } 

                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <td  align="center"><?php echo (!empty($record) && !empty($record->marked_at) && $record->marked_at != "0000-00-00 00:00:00") ? date("h:i A", strtotime($record->marked_at)) : "--"; ?></td>
                                                                        <td> 
                                                                            <select class="form-control status" title="<?php echo $t; ?>" name="status_<?php echo $staff->staffid; ?>" required="">
                                                                                <option value=""></option>
                                                                                <option value="2" selected>Leave</option>
                                                                                <option value="1" <?php echo (isset($record->status) && $record->status == 1) ? 'selected' : "" ?>>Present</option>
                                                                                <option value="4" <?php echo (isset($record->status) && $record->status == 4) ? 'selected' : "" ?>>Half Day</option>
                                                                                <option value="5" <?php echo (isset($record->status) && $record->status == 5) ? 'selected' : "" ?>>Over Time</option>
                                                                                <option value="3" <?php echo (isset($record->status) && $record->status == 3) ? 'selected' : "" ?>>Off</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane <?php echo ($page == "nontaxable") ? "active" : ""; ?>" id="nontaxable">
                                            <?php
                                                foreach ($staff_list["nontaxable"] as $bid => $staff_data) {
                                                   
                                                    $info = $this->db->query("SELECT comp_branch_name FROM `tblcompanybranch` where id = '" . $bid . "' ")->row();
                                                    if (!empty($staff_data)) {
                                                        echo '<tr><h3 align="center" class="text-danger">' . $info->comp_branch_name . '</h3></tr><hr>';
                                            ?>
                                                    <div class="table-responsive">  
                                                        <table class="display" id="">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S.No</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Start Hour</th>
                                                                        <th>End Hour</th>
                                                                        <th>Marked at</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($staff_data as $k => $staff) {
                                                                         ++$t;
                                                                            $record = $this->home_model->get_row('tblstaffattendance', array('staff_id' => $staff->staffid, 'date' => $att_date), '');

                                                                            $staff_info = $this->home_model->get_row('tblstaff', array('staffid' => $staff->staffid), '');
																			
																			
                                                                    ?>
                                                                        
                                                                        <tr>
                                                                            <td><?php echo ++$k; ?><input type="hidden" name="staff_id[]" value="<?php echo $staff->staffid; ?>"></td>
                                                                            <td>
                                                                                <?php
                                                                                if(!empty($record)){
                                                                            ?>
                                                                            <input type="hidden" value="<?php echo $record->approved_by; ?>" name="approved_by_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="<?php echo $record->updated_at; ?>" name="updated_at_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="<?php echo $record->marked_at; ?>" name="marked_at_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="<?php echo $record->by_biomax; ?>" name="by_biomax_<?php echo $staff->staffid; ?>">
                                                                            <?php    
                                                                            }else{
                                                                            ?>
                                                                            <input type="hidden" value="0" name="approved_by_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="" name="updated_at_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="" name="marked_at_<?php echo $staff->staffid; ?>">
                                                                            <input type="hidden" value="0" name="by_biomax_<?php echo $staff->staffid; ?>">
                                                                            <?php    
                                                                            }
                                                                                ?>

                                                                                <?php echo $staff->firstname; ?></td>

                                                                            <td>
                                                                                <select class="form-control" disabled required="" id="working_from_<?php echo $staff->staffid; ?>" name="working_from_<?php echo $staff->staffid; ?>" data-live-search="true">
                                                                                    <option value="" disabled selected>--Select One--</option>
                                                                                    <?php
                                                                                    for ($hours = 0; $hours < 24; $hours++) {
                                                                                        for ($mins = 0; $mins < 60; $mins+=30) {
                                                                                            $value = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                                                                                            ?>
                                                                                            <option value="<?php echo $value ?>" <?php echo (isset($staff_info->working_from) && $staff_info->working_from == $value) ? 'selected' : "" ?>><?php echo $value ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <select class="form-control" disabled required="" id="working_to_<?php echo $t; ?>" name="working_to_<?php echo $staff->staffid; ?>"  data-live-search="true">
                                                                                    <option value="" disabled selected>--Select One--</option>
                                                                                    <?php
                                                                                    for ($hours = 0; $hours < 24; $hours++) {
                                                                                        for ($mins = 0; $mins < 60; $mins+=30) {
                                                                                            $value = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                                                                                            ?>
                                                                                            <option value="<?php echo $value ?>" <?php echo (isset($staff_info->working_to) && $staff_info->working_to == $value) ? 'selected' : "" ?>  <?php if (!empty($record->working_to) && $record->working_to == $value) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $value ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                            <td  align="center"><?php echo (!empty($record) && !empty($record->marked_at) && $record->marked_at != "0000-00-00 00:00:00") ? date("h:i A", strtotime($record->marked_at)) : "--"; ?></td>
                                                                            <td> 
                                                                                <select class="form-control status" title="<?php echo $t; ?>" name="status_<?php echo $staff->staffid; ?>" required="">
                                                                                    <option value=""></option>
                                                                                    <option value="2" selected>Leave</option>
                                                                                    <option value="1" <?php echo (isset($record->status) && $record->status == 1) ? 'selected' : "" ?>>Present</option>
                                                                                    <option value="4" <?php echo (isset($record->status) && $record->status == 4) ? 'selected' : "" ?>>Half Day</option>
                                                                                    <option value="5" <?php echo (isset($record->status) && $record->status == 5) ? 'selected' : "" ?>>Over Time</option>
                                                                                    <option value="3" <?php echo (isset($record->status) && $record->status == 3) ? 'selected' : "" ?>>Off</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
																		
																		
                                                                    }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
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

<script type="text/javascript">
    $(function () {
        
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    
    $(document).ready(function() {
        $('table.display').DataTable( {
            "bPaginate": false
        } );
    });    
    
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#date', function () {
//        $("#attendance_form").submit();
    });
</script> 

<script type="text/javascript">
    $(document).on('change', '.status', function () {
        var tid = $(this).attr('title');
        
        var status = $(this).val();

        if (status == 5) {

            $("#working_to_" + tid).prop("disabled", false);
        } else {
            $("#working_to_" + tid).prop("disabled", true);
        }


        //$("#attendance_form").submit();	
    });
</script> 

</body>
</html>
