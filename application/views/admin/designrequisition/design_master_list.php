<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> </h4>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                          <?php echo form_open($this->uri->uri_string(), array('id' => 'design-requisition-form', 'class' => 'design-requisition-form')); ?>
                              <div class="row">
                                  <div class="form-group">
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
                                  </div>
                                  <div class="col-md-2">
                                      <div class="input-group" style="margin-top: 20px;">
                                          <button type="submit" class="btn btn-info">Search</button>
                                          <a class="btn btn-danger" href="">Reset</a>
                                      </div>
                                  </div>
                              </div>
                          <?php echo form_close(); ?>
                              <div class="row">
                                  <div class="table-responsive">
                                      <div class="col-md-12">
                                      <table class="table" id="newtable">
                                          <thead>
                                              <tr>
                                                  <th>S.No</th>
                                                  <th>Added By</th>
                                                  <th>Date</th>
                                                  <th>Drawing Name</th>
                                                  <th>Drawing ID</th>
                                                  <th>Approved By</th>
                                                  <th>Remark of Standard Conversion</th>
                                                  <th>Created At</th>
                                                  <th>Drawing Attachment</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                              if (!empty($designmaster_list)) {
                                                  $i = 1;
                                                  foreach ($designmaster_list as $key => $row) {
                                             ?>
                                                      <tr>
                                                          <td><?php echo ++$key; ?></td>
                                                          <td><span class="badge badge-info"><?php echo ($row->added_by > 0) ? get_employee_fullname($row->added_by) : 'N/A'; ?></span></td>
                                                          <td><?php echo _d($row->date); ?></td>
                                                          <td><?php echo value_by_id("tbldesignsubmission", $row->designsubmission_id, "drawing_name"); ?></td>
                                                          <td><?php echo value_by_id("tbldesignsubmission", $row->designsubmission_id, "drawing_id"); ?></td>
                                                          <td><?php echo get_employee_name($row->approved_by); ?></td>
                                                          <td><?php echo $row->remark; ?></td>
                                                          <td><?php echo _d($row->created_at); ?></td>
                                                          <td>
                                                              <a href="javascript:void(0)" class="status" data-target="#drawingattachment<?php echo $key; ?>" id="status" data-toggle="modal">View Drawing</a>
                                                              <div id="drawingattachment<?php echo $key; ?>" class="modal fade" role="dialog">
                                                                  <div class="modal-dialog">
                                                                      <!-- Modal content-->
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                              <h4 class="modal-title" style="color:#fff">Drawing Attachment</h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="table-responsive">
                                                                                        <div class="form-group" id="docAttachDivVideo" >
                                                                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                    <th width="1%" align="left">S.No</th>
                                                                                                    <th width="30%" align="left">Remark</th>
                                                                                                    <th width="10%" align="left">Uploaded Design</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                <?php
                                                                                                    $i = 0;
                                                                                                    $drequisition_remarks = $this->db->query("SELECT * FROM `tbldesignrequisitionremark` WHERE `id` IN (".$row->remark_ids.") ")->result();
                                                                                                    if (isset($drequisition_remarks) && !empty($drequisition_remarks)){
                                                                                                        foreach ($drequisition_remarks as $value) {
                                                                                                ?>
                                                                                                        <tr class="main" id="tre<?php echo $i; ?>">
                                                                                                            <td><?php echo ++$i; ?></td>
                                                                                                            <td><?php echo (!empty($value->remark)) ? cc($value->remark) : "";?></td>
                                                                                                            <td>
                                                                                                            <div class="form-group">
                                                                                                                <?php if (!empty($value->design_files)){
                                                                                                                    $designfiles = json_decode($value->design_files);
                                                                                                                    foreach ($designfiles as $k => $file) {
                                                                                                                ?>
                                                                                                                    <?php echo $k+1; ?>) <a href="<?php echo base_url('uploads/design_requisition/design_remarks_files') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                                                                                <?php
                                                                                                                    }
                                                                                                                } ?>

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
                                                                          <div class="modal-footer">
                                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
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


            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <div id="requisition_status" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assigned Person</h4>
                </div>
                <div class="modal-body requisition_status_details"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="productionremark" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <?php echo form_open(admin_url("Designrequisition/update_remark"), array('id' => 'sub_form_order')); ?>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Production Remarks</h4>
                </div>
                <div class="modal-body">
                  <div class="row productionremark_html"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" autocomplete="off" class="btn btn-info remarkbtn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div id="designsubmission" class="modal fade designsubmission_html" role="dialog">

    </div>
<?php init_tail(); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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

        $(document).ready(function () {
            $('#newtable').DataTable();
            $('#newtable2').DataTable();
        });

        function get_assign_status(id, section){
            var url = "<?php echo site_url('admin/Designrequisition/get_assign_status/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id+'/'+section,
                success: function (res) {
                    $('.requisition_status_details').html(res);
                }
            });
        }

        function get_production_remark(id){
            $(".remarkbtn").show();
            var ttlsubmission = $(".ttlsubmission"+id).val();
            if (ttlsubmission == "Y"){
                $(".remarkbtn").hide();
            }

            var url = "<?php echo site_url('admin/Designrequisition/get_production_remark/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id,
                success: function (res) {
                    $('.productionremark_html').html(res);
                }
            });
        }

        function get_design_submission(id){
            var url = "<?php echo site_url('admin/Designrequisition/get_design_submission/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id,
                success: function (res) {
                    $('.designsubmission_html').html(res);
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        }

        $(document).on("click", ".processcheck", function(){
           var process = $(".process-per").text();
           var total_complete = $(".totalcomplete").val();
           var totalstep = $(".totalstep").val();

           var persent = parseInt(process);
           if($(this).prop("checked") == true){
               total_complete = parseInt(total_complete)+1;
               var percentage =  Math.round((total_complete / totalstep) * 100);
               $(".process-per").html(percentage);
               $(".totalcomplete").val(total_complete);
               $(".progress-bar").css('width', percentage+'%');
           }else{
               total_complete = parseInt(total_complete)-1;
               var percentage = Math.round((total_complete / totalstep) * 100);
               $(".process-per").html(percentage);
               $(".totalcomplete").val(total_complete);
               $(".progress-bar").css('width', percentage+'%');
           }
        });
    </script>
</body>
</html>


<script type="text/javascript">
    $(document).on('click', '.handover', function () {

        var handover_id = $(this).val();
        if (handover_id > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/handover/get_handover_data'); ?>",
                data: {'handover_id': handover_id},
                success: function (response) {
                    if (response != '') {


                        $('#handover_data').html(response);
                    }
                }
            })
        }


    });
</script>
