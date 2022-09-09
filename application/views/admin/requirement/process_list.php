
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

    .popover{
        top: 70.4167px;
        left: 288.158px;
        display: block;
        max-width: revert;
    }

</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <!-- <a href="<?php echo admin_url('holidays/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Holiday</a> --></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">

                    <div class="row col-md-12">
                        <!-- <div class="form-group col-md-4" id="employee_div">
                            <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                            <select class="form-control" id="year" name="year">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                $j = date('Y');
                                for($i=2018; $i<=$j; $i++){
                                    ?>
                                    <option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div> -->
                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>        
                        <div class="form-group col-md-4">
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                    </div>

                        <div class="">


                            <div class="col-md-12 table-responsive">
                                <hr>
                                <table class="table ui-table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Request ID</th>
                                        <th>Added By</th>
                                        <th>Remark</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($requirement_info)){
                                        $i=1;
                                        foreach($requirement_info as $row){

                                            $prohtml = '';
                                            $req_products  = $this->db->query("SELECT `product_name`,`quantity` FROM `tblrequirement_products` where req_id = '".$row->id."'  ")->result();
                                            if (!empty($req_products)){
                                                $prohtml .= "<table class='table ui-table'><thead><tr><th>Product Name</th><th>Quantity</th></tr></thead><tbody>";
                                                foreach ($req_products as $val) {
                                                    $productname = str_replace('"','&quot;', $val->product_name);
                                                    $prohtml .= "<tr><td>".cc($productname)."</td><td>".$val->quantity."</td></li></tr>";
                                                }
                                                $prohtml .= "</tbody></table>";
                                            }
                                            $approval_send  = $this->db->query("SELECT id FROM tblrequirementprocess_approval where req_id = '".$row->id."'  ")->row();
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><a href="javascript:void(0);" data-html="true" data-container="body" data-toggle="popover" data-placement="top" data-content="<?php echo $prohtml; ?>"><?php echo 'P-REQ-'.str_pad($row->id, 4, '0', STR_PAD_LEFT);?></a></td>
                                                <td><?php echo get_employee_name($row->staff_id);?></td>
                                                <td><?php echo cc($row->remark);?></td>
                                                <td><?php echo date('d-m-Y h:i a',strtotime($row->created_at));?></td>
                                                <td class="text-center">

                                                    <?php
                                                    if ($row->purchase_person_status == 1){

                                                        if($row->approve_status == 1){
                                                            $approve_status = 'Approved';
                                                            $status_cls = 'btn-success';
                                                        }elseif($row->approve_status == 2){
                                                            $approve_status = 'Rejected';
                                                            $status_cls = 'btn-danger';
                                                        }else{
                                                            $approve_status = 'Pending';
                                                            $status_cls = 'btn-warning';
                                                        }
                                                       //$approve_status = ($row->approve_status == 1) ? 'Approved':'Pending';
                                                       //$status_cls = ($row->approve_status == 1) ? 'btn-success':'btn-warning';
                                                       echo '<a href="javascript:void(0);" class="btn-sm '.$status_cls.' adminstatus" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">'.$approve_status.'</a>&nbsp;';
                                                    }
                                                    if($row->purchase_person_status == 1 && ($row->approve_status == 0 || $row->approve_status == 2)){
                                                       echo '<a style="width:86px"  href="'.admin_url('requirement/edit_purchase_process/'.$row->id).'" class="btn-sm btn-info" >Edit</a>&nbsp;';
                                                    }
                                                    if(!empty($approval_send)){
                                                        echo '<a style="width:86px"  class="btn-sm btn-success" target="_blank" href="'.admin_url('requirement/requirement_process_view/'.$row->id).'">View</a>';
                                                    }else{
                                                        echo '<a style="width:86px"  href="'.admin_url('requirement/purchase_process/'.$row->id).'" class="btn-sm btn-info" >Action</a>';
                                                    }
                                                    ?>



                                                </td>

                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
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
<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Requirement Status</h4>
            </div>
            <div class="modal-body" id="approval_html"></div>
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
<script>

    $(document).ready(function () {
        $('#newtable').DataTable();
    });
    $('.adminstatus').click(function () {
        var id = $(this).attr("value");
        var type = $(this).data("type");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/requirement/get_process_status'); ?>",
            data: {'id': id, 'type': type},
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
