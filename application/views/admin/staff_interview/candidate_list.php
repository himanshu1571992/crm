
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?> <?php echo (!empty($designation_id)) ? " <span class='text-danger'>( ".value_by_id_empty("tbldesignation", $designation_id, "designation")." )</span>" : ""; ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
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

                        <div class="">
                            <div class="col-md-12">
                                <hr>

                                <div class="table-responsive">

                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Candidate Name</th>
                                                    <th>Interview Date</th>
                                                    <th>Interviewer Name</th>
                                                    <th>Round</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($candidate_list)) {

                                                    foreach ($candidate_list as $key => $value) {

                                                        if($value->interview_round == 1){
                                                            $interview_round = "Screening Round";
                                                        }elseif ($value->interview_round == 2) {
                                                            $interview_round = "1st Round";
                                                        }elseif ($value->interview_round == 3) {
                                                            $interview_round = "Final Round";
                                                        }

                                                        $next_round = "";
                                                        if (!in_array($value->interview_round, [3,4])){
                                                            $chk_second_round = $this->db->query("SELECT * FROM tblstaffinterviewdetails WHERE parent_id =".$value->parent_id." and interview_round = 2")->result();
                                                            if(empty($chk_second_round)){

                                                               $next_round = '<li><a href="'.admin_url('staff_interview/add_next_round/' . $value->id.'/2').'">Take 1st round </a></li>';
                                                            }  else {
                                                                $chk_final_round = $this->db->query("SELECT * FROM tblstaffinterviewdetails WHERE parent_id =".$value->parent_id." and interview_round = 3 ")->result();
                                                                if(empty($chk_final_round)){
                                                                    $next_round = '<li><a href="'.admin_url('staff_interview/add_next_round/' . $value->id.'/3').'">Take Final round </a></li>';
                                                                }
                                                            }
                                                        }
                                                        $ratinghtml = "";
                                                        if ($value->relevance == 1){
                                                            $ratinghtml .= "<i class='fa fa-star' style='color:#FFD700'></i>";
                                                        }
                                                        if ($value->willingnesstojoin == 1){
                                                            $ratinghtml .= "<i class='fa fa-star' style='color:#FFD700'></i>";
                                                        }
                                                        if ($value->cost_competence == 1){
                                                            $ratinghtml .= "<i class='fa fa-star' style='color:#FFD700'></i>";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo ++$key; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo get_creator_info($value->added_by, $value->created_at); ?>
                                                                <?php echo cc($value->candidate_name)." ".$ratinghtml; ?>
                                                            </td>
                                                            <td><?php echo _d($value->date); ?></td>
                                                            <td><?php echo cc($value->interviewer_name); ?></td>
                                                            <td><?php echo $interview_round; ?></td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($value->parent_id > 0){ ?>
                                                                        <a target="_blank" href="<?php echo admin_url('staff_interview/view_interview_details/' . $value->parent_id); ?>" class="label label-success" data-status="1">View Screening Round</a>
                                                                <?php  }
                                                                      if ($value->parent_id > 0 && $value->interview_round == 3){
                                                                          $oldinterviewdata = $this->db->query("SELECT `id` FROM `tblstaffinterviewdetails` WHERE `interview_round` = '2' AND `parent_id` = '".$value->parent_id."' ")->row();
                                                                          if (!empty($oldinterviewdata)){
                                                                ?>
                                                                              <br><br><a target="_blank" class="label label-success" href="<?php echo admin_url('staff_interview/view_interview_details/' . $oldinterviewdata->id); ?>" data-status="1">View 1st Round</a>
                                                                <?php
                                                                          }
                                                                      }
                                                                ?>
                                                                <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                            <a href="<?php echo admin_url('staff_interview/add_interview_details/' . $value->id.'/'.$value->interview_round); ?>" data-status="1">Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a target="_blank" href="<?php echo admin_url('staff_interview/view_interview_details/' . $value->id); ?>" data-status="1">View</a>
                                                                        </li>

                                                                        <li>
                                                                            <a target="_blank" href="<?php echo site_url("uploads/interview_resume/".$value->resume);?>">Resume View</a>
                                                                        </li>
                                                                        <?php echo $next_round; ?>
                                                                        <li>
                                                                            <a class="_delete" href="<?php echo admin_url('staff_interview/confirm_employee/' . $value->id); ?>" data-status="1">Confirm Employee</a>
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
                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

         Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assigned Person</h4>
            </div>
            <div class="modal-body">
                <div id="approval_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

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
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            'colvis',
        ]
    } );
} );


</script>
<script type="text/javascript">
    $('.status').click(function () {
        var items_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/staff_iteams/get_items_approval_info'); ?>",
            data: {'items_id': items_id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>
</body>
</html>
