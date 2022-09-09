<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 75px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->

              <div id="wrapper">
                  <div class="content accounting-template">
                      <a data-toggle="modal" id="modal" data-target="#myModal"></a>
                      <div class="row">
                          <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?></h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Design ID</label>
                                                        <input type="text" class="form-control" readonly name="design_id" value="<?php echo $design_id;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Drawing Name</label>
                                                        <input type="text" class="form-control" readonly name="drawing_name" value="<?php echo (isset($submission_info)) ? $submission_info->drawing_name: "";?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Drawing ID</label>
                                                        <input type="text" class="form-control" readonly name="drawing_id" value="<?php echo (isset($submission_info)) ? $submission_info->drawing_id: "";?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="assign_production" class="control-label">Assign To Production</label>
                                                        <select class="form-control selectpicker" id="assign_to_production" required="" name="assignproductionid[]" multiple="" data-live-search="true">
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="remark" class="control-label">Remark of Standard Conversion</label>
                                                        <textarea name="remark" rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                                           <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                                <?php echo _l('send_for_approval'); ?>
                                            </button> -->
                                            <a href="javascript:void(0);" class="btn btn-info masterdesign"><?php echo _l('send_for_approval'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="customer-profile-group-heading">Add Remarks</h4>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="table-responsive s_table">
                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                                        <thead>
                                                            <tr>
                                                                <th width="30%" align="left">Remark</th>
                                                                <th width="10%" align="left">Upload Design</th>
                                                                <th width="1%"  align="center"><i class="fa fa-cog"></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ui-sortable">
                                                            <?php
                                                                $i = 0;

                                                                if (isset($drequisition_remarks) && !empty($drequisition_remarks)){
                                                                   foreach ($drequisition_remarks as $value) {
                                                            ?>
                                                                  <tr class="main" id="tre<?php echo $i; ?>">
                                                                      <td>
                                                                          <?php echo (!empty($value->remark)) ? cc($value->remark) : "";?>
                                                                      </td>
                                                                      <td>
                                                                        <div class="form-group">
                                                                          <?php if (!empty($value->design_files)){
                                                                              $filesdata = json_decode($value->design_files);
                                                                              foreach ($filesdata as $k => $file) {
                                                                          ?>
                                                                                <?php echo $k+1; ?>) <a href="<?php echo base_url('uploads/design_requisition/design_remarks_files') ."/". $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                                          <?php
                                                                              }
                                                                          } ?>
                                                                        </div>
                                                                      </td>
                                                                      <td><input type="checkbox" class="checkremark" name="remark_id[]" value="<?php echo $value->id; ?>"></td>
                                                                  </tr>
                                                            <?php
                                                                     $i++;
                                                                   }
                                                                }else{
                                                            ?>
                                                                  <tr class="main" id="tre<?php echo $i; ?>">
                                                                      <td><button type="button" class="btn pull-right btn-danger"  onclick="removepointerremark('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button></td>
                                                                      <td><textarea class="form-control" required="" name="drequisitionremark[<?php echo $i; ?>][remark]"></textarea></td>
                                                                      <td><input type="file" class="form-control" name="design_requisition<?php echo $i; ?>[]" multiple=""></td>
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
                            <?php echo form_close(); ?>
            				        <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<script type="text/javascript">
    $(".masterdesign").on("click", function(){
        var count = 0;
        $(".checkremark").each(function(){
            if ($(this).prop('checked')==true){
                count = count +1;
            }
        });
        if (count > 0){
           $("#proposal-form").submit();
        }else{
           alert("Please check at list one remark");
        }
    });
</script>
</body>

</html>
