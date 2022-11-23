<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}
</style>

<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4><?php echo $title; ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="text-info"> Design ID : </label>
                                        <div class="form-group">
                                            <span><?php echo (isset($dsubmission_info)) ? "DR-".str_pad($dsubmission_info->designrequisition_id, 3, '0', STR_PAD_LEFT): ''; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-info"> Drawing Name : </label>
                                        <div class="form-group">
                                            <span><?php echo (isset($dsubmission_info)) ? value_by_id("tbldesignsubmission", $dsubmission_info->designsubmission_id, "drawing_name"): ''; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="text-info"> Drawing ID : </label>
                                        <div class="form-group">
                                            <span><?php echo (isset($dsubmission_info)) ? value_by_id("tbldesignsubmission", $dsubmission_info->designsubmission_id, "drawing_id"): ''; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                      <label class="text-info"> Remark of Standard Conversion : </label>
                                      <div class="form-group">
                                          <span><?php echo (isset($dsubmission_info)) ? $dsubmission_info->remark : ''; ?></span>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            // if ($section == "approval" OR $section == "designapproval"){
                                if(empty($appvoal_info)){
                        ?>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Reject
                                    </button>
                                    <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Approve
                                    </button>
                                </div>
                        <?php
                                }
                            // }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Add Remarks</h4>
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
                                                              <th width="30%" align="left">Remark</th>
                                                              <th width="10%" align="left">Uploaded Design</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
                                                              $i = 0;
                                                              $drequisition_remarks = $this->db->query("SELECT * FROM `tbldesignrequisitionremark` WHERE `id` IN (".$dsubmission_info->remark_ids.") ")->result();
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                 // if ($section == "approval" OR $section == "designapproval"){
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
                                        <div class="col-md-12">
                                           <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                 // }
           ?>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

</body>
</html>
