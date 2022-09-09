<div class="modal-dialog modal-lg" style="width: 75%;">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $title; ?></h4>
        </div>
        <div class="modal-body">

              <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <?php echo form_open_multipart(admin_url("Designrequisition/add_design_submission"), array('id' => 'sub_form_order')); ?>
                                <div class="col-md-12 submission-section">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drawing_id" class="control-label">Request ID </label>
                                            <input type="text" required="" id="drawing_id" name="drawing_id" value="<?php echo "DRS-".str_pad($design_requisition_id, 3, '0', STR_PAD_LEFT); ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drawingfile" class="control-label">Drawing</label>
                                            <input type="file" id="drawingfile" name="designsubmission_files[]" multiple="" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="assign_production" class="control-label">Assign To Production</label>
                                            <select class="form-control selectpicker" required='' id="assign_to_production" required="" name="assignproductionid[]" multiple="" data-live-search="true">
                                                <option value=""></option>
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
                                </div>
                                <div class="col-md-12 submission-section">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="remark" class="control-label">Remark</label>
                                          <textarea id="remark" required="" name="remark" class="form-control"></textarea>
                                      </div>
                                  </div>
                                </div>
                                <?php
                                    $design_status = value_by_id_empty("tbldesignrequisition", $design_requisition_id, "design_status");
                                    if ($design_status == 1){
                                ?>
                                      <div class="col-md-12">
                                          <a href="javascript:void(0);" class="btn-sm btn-info pull-right" onclick="reassigndesign();">Design Revised</a><br><br>
                                      </div>

                                <?php } ?>
                                <?php if (!empty($designsubmission_list)) { ?>
                                    <div class="col-md-12">
                                  <div class="table-responsive s_table">
                                      <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTabledrawing">
                                          <thead>
                                              <tr>
                                                  <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                  <th width="20%" align="left">Request ID</th>
                                                  <th width="20%" align="left">Drawing</th>
                                                  <th width="20%" align="left">Remark</th>
                                                  <th width="20%" align="left">Status</th>
                                                  <th width="20%" align="left">Approve / Reject Remark</th>
                                              </tr>
                                          </thead>
                                          <tbody class="ui-sortable">
                                              <?php
                                                  $i = 0;
                                                  foreach ($designsubmission_list as $designsubmission) {
                                                      $i++;
                                                      if ($designsubmission->status == 1){
                                                          $design_status = '<label class="btn-sm btn-success">Approved</label>';
                                                      }else if ($designsubmission->status == 2){
                                                          $design_status = '<label class="btn-sm btn-danger">Rejected</label>';
                                                      }else if ($designsubmission->status == 3){
                                                          $design_status = '<label class="btn-sm btn-info">Revised</label>';
                                                      }else{
                                                          $design_status = '<label class="btn-sm btn-warning">Pending</label>';
                                                      }

                                                      $approve_remark = $this->db->query("SELECT `approvereason` FROM `tbldesignsubmissionapproval` WHERE `designsubmission_id` = '".$designsubmission->id."' AND `approve_status` = '".$designsubmission->status."' ")->row();
                                              ?>
                                                      <tr>
                                                          <td align="center"><?php echo $i; ?></td>
                                                          <td><?php echo $designsubmission->drawing_id; ?></td>
                                                          <td>
                                                            <div class="form-group">
                                                              <?php if (!empty($designsubmission->files)){
                                                                  $filesdata = json_decode($designsubmission->files);
                                                                  foreach ($filesdata as $k => $file) {
                                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                    if (in_array(strtolower($extension), ["jpg", "png"])){
                                                              ?>
                                                                    <a href="<?php echo base_url('uploads/design_requisition/design_submission') . "/" . $file; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition/design_submission') ."/". $file; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                              <?php
                                                            }else{
                                                              ?>
                                                                    <a href="<?php echo base_url('uploads/design_requisition/design_submission') . "/" . $file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                              <?php
                                                            }
                                                            }
                                                          }else{
                                                            echo '--';
                                                          } ?>
                                                            </div>
                                                         </td>
                                                         <td><?php echo $designsubmission->remark; ?></td>
                                                         <td><?php echo $design_status; ?></td>
                                                         <td><?php echo (!empty($approve_remark) && !empty($approve_remark->approvereason)) ? cc($approve_remark->approvereason) : "--"; ?></td>
                                                      </tr>
                                                      <?php
                                                  }
                                              ?>
                                          </tbody>
                                      </table>
                                  </div>
                                </div>
                                <?php } ?>
                                <input type="hidden" name="designrequisition_id" value="<?php echo $design_requisition_id; ?>">
                                <button type="submit" style="display:none;"  autocomplete="off" class="btn btn-info submission-section pull-right">Submit</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <?php echo form_open_multipart(admin_url("Designrequisition/add_remark_upload"), array('id' => 'sub_form_order')); ?>
                            <div class="col-md-12">
                                <h4>Remarks List</h4>
                                <div class="table-responsive s_table">
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTablesubmission">
                                        <thead>
                                            <tr>
                                                <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                <th width="20%" align="left">Drawing Name</th>
                                                <th width="20%" align="left">Description</th>
                                                <th width="20%" align="left">Drawing ID</th>
                                                <th width="20%" align="left">Upload Design</th>
                                                <th width="20%" align="left">Remarks</th>
                                                <th width="20%" align="left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php
                                                $r = 1;
                                                if (isset($drequisition_remarks)){
                                                   foreach ($drequisition_remarks as $remarkrow) {
                                            ?>
                                                    <tr id="tre<?php echo $r; ?>">
                                                      <td class="text-center"><?php echo $r; ?></td>
                                                      <td><input type="text" class="form-control" required="" name="drequisitionremark[<?php echo $r; ?>][drawing_name]" value="<?php echo (!empty($remarkrow->drawing_name)) ? $remarkrow->drawing_name : "";?>" ></td>
                                                      <td><?php echo (!empty($remarkrow->description)) ? cc($remarkrow->description) : "--";?></td>
                                                      <td><input type="text" class="form-control" name="drequisitionremark[<?php echo $r; ?>][drawing_id]" value="<?php echo (!empty($remarkrow->drawing_id)) ? cc($remarkrow->drawing_id) : "";?>"></td>
                                                      <td>
                                                          <input type="file" id="drawingremarkfile" name="drawingremarkfile<?php echo $remarkrow->id; ?>[]" multiple="" class="form-control" >
                                                          <input type="hidden" name="designremarkdata[]" value="<?php echo $remarkrow->id; ?>">
                                                          <input type="hidden" name="drequisitionremark[<?php echo $r; ?>][remark_id]" value="<?php echo $remarkrow->id; ?>">
                                                          <div class="form-group">
                                                            <?php if (!empty($remarkrow->design_files)){
                                                                $filesdata = json_decode($remarkrow->design_files);
                                                                foreach ($filesdata as $k => $file1) {
                                                            ?>
                                                                    <?php echo ++$k?>) <a href="<?php echo base_url('uploads/design_requisition/design_remarks_files') . "/" . $file1; ?>" target="_blank"><?php echo $file1; ?></a><br>
                                                            <?php
                                                                  }
                                                            } ?>
                                                          </div>
                                                      </td>
                                                      <td><textarea class="form-control" name="drequisitionremark[<?php echo $r; ?>][remark]" ><?php echo (!empty($remarkrow->remark)) ? $remarkrow->remark : "";?></textarea></td>
                                                      <td><a href="<?php echo admin_url('designrequisition/design_activity/' . $remarkrow->activity_id); ?>" target="_blank" class="btn-sm btn-info" title="activity" >Activity</a></td>
                                                    </tr>
                                            <?php
                                                      $r++;
                                                   }
                                                }
                                            ?>
                                        </tbody>
                                   </table>
                                    <div class="col-xs-12">
                                        <label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $r; ?>">Add More Remarks <i class="fa fa-plus"></i></a></label>
                                    </div>
                                </div>
                                <input type="hidden" name="designremark_id" value="<?php echo $design_requisition_id; ?>">
                                <button type="submit"  autocomplete="off" class="btn btn-info pull-right">Design Upload</button>
                            </div>
                        <?php echo form_close(); ?>
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
<script type="text/javascript">
    $(".submission-section").hide();
    var chk_section = "<?php echo ($checkdesign == 0) ? 1:2; ?>";
    if (chk_section == 1){
        $(".submission-section").show();
    }

    function reassigndesign(){
        $(".submission-section").show();
    }

    $(document).on("click", ".addmoreproenq",function(){

        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);

        $('#myTablesubmission tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removepointerremark('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><input type="text" class="form-control" required=""name="drequisitionremark['+newaddmoreproenq+'][drawing_name]" ></td><td><textarea class="form-control" name="drequisitionremark['+newaddmoreproenq+'][description]" ></textarea></td><td><input type="text" class="form-control" required="" name="drequisitionremark['+newaddmoreproenq+'][drawing_id]" ></td><td><input type="file" class="form-control" name="drawingremarkfile'+newaddmoreproenq+'[]" multiple=""><input type="hidden" name="drequisitionremark['+newaddmoreproenq+'][activity_id]" value="0"></td><td><textarea class="form-control" name="drequisitionremark['+newaddmoreproenq+'][remark]"></textarea></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    function removepointerremark(proid)
    {
        $('#tre' + proid).remove();
    }
</script>
</body>

</html>
