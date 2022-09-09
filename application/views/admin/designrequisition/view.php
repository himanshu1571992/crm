<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <?php if ($section == "designapproval"){ ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4>Design Submission for Approval</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-info"> Drawing ID : </label>
                                            <div class="form-group">
                                                <span><?php echo  $dsubmission_info->drawing_id; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-info"> Drawing Files : </label>
                                            <div class="form-group">
                                                <span><?php if (!empty($dsubmission_info->files)){
                                                    $filesdata = json_decode($dsubmission_info->files);
                                                    foreach ($filesdata as $k => $file) {
                                                      $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                      if (in_array(strtolower($extension), ["jpg", "jpeg", "png"])){
                                                ?>
                                                      <a href="<?php echo base_url('uploads/design_requisition/design_submission') . "/" . $file; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition/design_submission') ."/". $file; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                <?php }else{ ?>
                                                      <a href="<?php echo base_url('uploads/design_requisition/design_submission') . "/" . $file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <?php  }
                                                    }
                                                }else{
                                                  echo '--';
                                                } ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="text-info"> Remark : </label>
                                            <div class="form-group">
                                                <span><?php echo  cc($dsubmission_info->remark); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4><?php echo $title; ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="text-info"> Request No. : </label>
                                        <div class="form-group">
                                            <span><?php echo  $design_id; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-info">Product Type : </label>
                                        <div class="form-group">
                                            <span><?php echo ($drequisition_info->product_type == 1) ? 'Standard':'Customized'; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-info">Type : </label>
                                        <div class="form-group">
                                            <span>
                                              <?php
                                                    if ($drequisition_info->type == 1){
                                                        echo 'Staff &nbsp;';
                                                        echo "<span class='btn-sm btn-success'> ".get_employee_fullname($drequisition_info->added_by)."</span>";
                                                    }else{
                                                        echo 'Client &nbsp;';
                                                        if ($drequisition_info->client_id > 0){
                                                            echo "<span class='btn-sm btn-success'> ".client_info($drequisition_info->client_id)->client_branch_name."</span>";
                                                        }else{
                                                            echo "<span class='btn-sm btn-success'> ".cc($drequisition_info->client_name)."</span>";
                                                        }
                                                    }
                                              ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-info"> Attachments : </label>
                                        <div class="form-group">
                                          <?php
                                          if (isset($drequisition_info)){
                                              $filesdata = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`= '".$drequisition_info->id."' AND `rel_type`='design_requisition'")->result();
                                              if (!empty($filesdata)){
                                                  foreach ($filesdata as $k => $file) {
                                                    $extension = pathinfo($file->file_name, PATHINFO_EXTENSION);
                                                    if (in_array(strtolower($extension), ["jpg", "jpeg","png"])){
                                          ?>
                                                    <a href="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                          <?php
                                                    }else{
                                          ?>
                                                    <a href="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                          <?php
                                                    }
                                                  }
                                              }
                                          }
                                          ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($section == "approval" OR $section == "designapproval"){ ?>
                                      <div class="row">
                                        <div class="col-md-4">
                                            <label class="text-info">Added By : </label>
                                            <div class="form-group">
                                                <span><?php echo get_employee_name($drequisition_info->added_by); ?></span>
                                            </div>
                                        </div>
                                      </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                            if ($section == "approval" OR $section == "designapproval"){
                                if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                        ?>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <?php if ($section == "approval"){ ?>
                                    <button type="submit" name="submit" value="5" style="background-color: #e8bb0b;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                        On Hold
                                    </button>
                                    <button type="submit" name="submit" value="4" style="background-color: #800000;" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit button3">
                                        Reconciliation
                                    </button>
                                    <?php } ?>
                                    <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Reject
                                    </button>
                                    <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Approve
                                    </button>
                                </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Add Design Description</h4>
                            </div>
                            <div class="col-md-12">
                              <hr/>
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <div class="col-md-12">
                                            <div >
                                                <div class="form-group" id="docAttachDivVideo" >
                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                        <thead>
                                                            <tr>
                                                              <th width="1%" align="left">S.No</th>
                                                              <th width="10%" align="left">Drawing Name</th>
                                                              <th width="20%" align="left">Description</th>
                                                              <th width="10%" align="left">Drawing ID</th>
                                                              <th width="10%" align="left">Uploaded Images</th>
                                                              <th width="10%" align="left">Uploaded Design</th>
                                                              <th width="20%" align="left">Remark</th>
                                                              <th width="10%" align="left">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
                                                              $i = 0;
                                                              if (isset($drequisition_remarks) && !empty($drequisition_remarks)){
                                                                 foreach ($drequisition_remarks as $value) {
                                                          ?>
                                                                <tr class="main" id="tre<?php echo $i; ?>">
                                                                    <td><?php echo ++$i; ?></td>
                                                                    <td><?php echo (!empty($value->drawing_name)) ? cc($value->drawing_name) : "--";?></td>
                                                                    <td><?php echo (!empty($value->description)) ? cc($value->description) : "--";?></td>
                                                                    <td><?php echo (!empty($value->drawing_id)) ? cc($value->drawing_id) : "--";?></td>
                                                                    <td>
                                                                      <div class="form-group">
                                                                        <?php if (!empty($value->files)){
                                                                            $filesdata = json_decode($value->files);
                                                                            foreach ($filesdata as $k => $file) {
                                                                              $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                              if (in_array(strtolower($extension), ["jpg", "jpeg", "png"])){
                                                                        ?>
                                                                              <a href="<?php echo base_url('uploads/design_requisition') . "/" . $file; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition') ."/". $file; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                                        <?php }else{ ?>
                                                                              <a href="<?php echo base_url('uploads/design_requisition') . "/" . $file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                                        <?php
                                                                              }
                                                                            }
                                                                        } ?>
                                                                        <input type="hidden" name="drequisitionremark[<?php echo $i; ?>][files]" value='<?php echo (isset($value->files) && !empty($value->files)) ? $value->files : ""; ?>'>
                                                                      </div>
                                                                    </td>
                                                                    <td>
                                                                      <div class="form-group">
                                                                        <?php if (!empty($value->design_files)){
                                                                            $designfiles = json_decode($value->design_files);
                                                                            foreach ($designfiles as $k => $file) {
                                                                        ?>
                                                                              <?php echo ++$k; ?>) <a href="<?php echo base_url('uploads/design_requisition/design_remarks_files') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                                        <?php
                                                                            }
                                                                        }else{
                                                                          echo '--';
                                                                        } ?>
                                                                        <input type="hidden" name="drequisitionremark[<?php echo $i; ?>][files]" value='<?php echo (isset($value->files) && !empty($value->files)) ? $value->files : ""; ?>'>
                                                                      </div>
                                                                    </td>                                                                    
                                                                    <td><?php echo (!empty($value->remark)) ? cc($value->remark) : "--";?></td>
                                                                    <td><a class="btn-sm btn-info" href="<?php echo admin_url('designrequisition/design_activity/' . $value->activity_id); ?>" target="_blank" title="activity" >Activity</a></td>
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
                    </div>
                </div>
            </div>
            <?php
                 if ($section == "approval"){
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group">
                                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                            <thead>
                                                <tr>
                                                    <td>S.No</td>
                                                    <td>Name</td>
                                                    <td>Status</td>
                                                    <td>Read At</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    foreach ($approval_details as $key => $value) {
                                                        $status = get_approve_status($value->approve_status);
                                                ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo get_employee_fullname($value->staff_id); ?></td>
                                                        <td><?php echo $status; ?></td>
                                                        <td><?php echo ($value->readdate !='') ? _d($value->readdate) : 'Not Yet'; ?></td>
                                                    </tr>
                                                <?php
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
            <?php
                 }
                 if ($section == "approval" OR $section == "designapproval"){
            ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 pull-right">
                                           <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->approvereason; } ?></textarea>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

</body>
</html>
