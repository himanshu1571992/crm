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
                                            <input type="hidden" name="enquirycall_id" value="<?php echo $enquirycall_id; ?>">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Request No.</label>
                                                        <input type="text" class="form-control" readonly name="design_id" value="<?php echo $design_id;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Product Type</label>
                                                        <select class="form-control selectpicker" id="product_type" name="product_type" required="" data-live-search="true">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($drequisition_info)) ? ($drequisition_info->product_type == 1) ? "selected=''": "": ""; ?>>Standard</option>
                                                            <option value="2" <?php echo (isset($drequisition_info)) ? ($drequisition_info->product_type == 2) ? "selected=''": "": ""; ?>>Customized</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="lead_type" class="control-label">Type</label>
                                                        <select class="form-control selectpicker dtype" id="type" name="type" required="" data-live-search="true">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($drequisition_info)) ? ($drequisition_info->type == 1) ? "selected=''": "": ""; ?>>Staff</option>
                                                            <option value="2" <?php echo (isset($drequisition_info)) ? ($drequisition_info->type == 2) ? "selected=''": "": ""; ?>>Client</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php
                                                            $chkpermission = get_staff_info(get_staff_user_id())->createdirectdesignrequisition;
                                                        ?>
                                                        <label for="assign_production" class="control-label">Assign To Production</label>
                                                        <select class="form-control selectpicker" <?php echo ($chkpermission == 0) ? 'required=""':''; ?> id="assign_to_production" name="assignproductionid[]" multiple="" data-live-search="true">
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
                                            <div class="col-md-12">
                                              <div class="">
                                                <div class="col-md-4 form-group staff_div" style="display:none;">
                                                    <label for="lead_type" class="control-label">Staff</label>
                                                    <select class="form-control selectpicker staff_id" id="staff_id" name="staff_id" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                            if (isset($staff_list) && !empty($staff_list)){
                                                                foreach ($staff_list as $value) {
                                                        ?>
                                                                    <option value="<?php echo $value->staffid; ?>" <?php echo (isset($drequisition_info) && $drequisition_info->staff_id == $value->staffid) ? "selected=''": ""; ?>><?php echo cc($value->firstname);?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 client_section" style="display:none;">
                                                    <?php
                                                        $clientval = 1;
                                                        $clienthtltitle = 'Select Client';
                                                        if (isset($drequisition_info) && $drequisition_info->client_id > 0){
                                                            $clientval = 2;
                                                            $clienthtltitle = 'Enter Client Name';
                                                        }
                                                    ?>
                                                    <label for="client_name" class="control-label client_title">Client Name</label><a href="javascript:void(0);" value="<?php echo $clientval; ?>" class="pull-right client_text"><?php echo $clienthtltitle; ?></a>
                                                    <div class="form-group client_div">
                                                        <?php
                                                            if(isset($drequisition_info) && $drequisition_info->client_id > 0){
                                                        ?>
                                                            <select class="form-control selectpicker clientselect" data-live-search="true" id="client_id" name="client_id"><option value=""></option>
                                                                <?php
                                                                    if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                                                        foreach ($client_branch_data as $client_branch_key => $client_branch_value){
                                                                            $select_cls = (isset($drequisition_info) && $drequisition_info->client_id == $client_branch_value->userid) ? "selected":"";
                                                                            echo '<option value="'.$client_branch_value->userid.'" '.$select_cls.'>'.cc($client_branch_value->client_branch_name).' - '.$client_branch_value->email_id.'</option>';
                                                                        }
                                                                    }

                                                                ?>
                                                            </select>
                                                        <?php
                                                            }else{
                                                                $client_name = (isset($drequisition_info)) ? $drequisition_info->client_name: "";
                                                        ?>
                                                        <input type="text" id="client_name" class="form-control clientname" value="<?php echo $client_name; ?>" name="client_name" placeholder="client name">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                              </div>
                                                
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label for="lead_type" class="control-label">Attachments</label>
                                                      <input type="file"  class="form-control" name="file[]" multiple="">
                                                      <?php
                                                      if (isset($drequisition_info)){
                                                          $filesdata = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`= '".$drequisition_info->id."' AND `rel_type`='design_requisition'")->result();
                                                          if (!empty($filesdata)){
                                                              foreach ($filesdata as $file) {
                                                                $extension = pathinfo($file->file_name, PATHINFO_EXTENSION);
                                                                if (in_array($extension, ["jpg", "png"])){
                                                      ?>
                                                                  <a href="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                      <?php
                                                                }else{
                                                      ?>
                                                                    <a href="<?php echo base_url('uploads/design_requisition') ."/". $drequisition_info->id ."/" . $file->file_name; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                      <?php          }
                                                              }
                                                          }
                                                      }
                                                      ?>
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php 
                                                            $value = (isset($drequisition_info) ? _d($drequisition_info->expected_date) : _d(date('Y-m-d')));
                                                            echo render_date_input('expected_date', 'Expected Date', $value); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                                           <button type="submit" name="sendapproval" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                                <?php echo _l('send_for_approval'); ?>
                                            </button>
                                            <?php

                                                  if ($chkpermission == 1){
                                                      echo '<button class="btn btn-success" name="directsubmit" value="1" type="submit">Direct Approved</button>';
                                                  }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="customer-profile-group-heading">Add Design Description</h4>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="table-responsive s_table">
                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%"  align="center"><i class="fa fa-cog"></i></th>
                                                                <th width="20%" align="left">Drawing ID</th>
                                                                <th width="20%" align="left">Drawing Name</th>
                                                                <th width="20%" align="left">Description</th>
                                                                <th width="20%" align="left">Remarks</th>
                                                                <th width="10%" align="left">Upload Image</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ui-sortable">
                                                            <?php
                                                                $i = 0;

                                                                if (isset($drequisition_remarks) && !empty($drequisition_remarks)){
                                                                   foreach ($drequisition_remarks as $value) {
                                                            ?>
                                                                  <tr class="main" id="tre<?php echo $i; ?>">
                                                                      <td><button type="button" class="btn pull-right btn-danger"  onclick="removepointerremark('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button></td>
                                                                      <td><input type="text" class="form-control" required="" name="drequisitionremark[<?php echo $i; ?>][drawing_id]" value="<?php echo (!empty($value->drawing_id)) ? $value->drawing_id : "";?>"></td>
                                                                      <td><input type="text" class="form-control" required="" name="drequisitionremark[<?php echo $i; ?>][drawing_name]" value="<?php echo (!empty($value->drawing_name)) ? $value->drawing_name : "";?>" ></td>
                                                                      <td><textarea class="form-control" name="drequisitionremark[<?php echo $i; ?>][description]" ><?php echo (!empty($value->description)) ? $value->description : "";?></textarea></td>
                                                                      <td><textarea class="form-control" name="drequisitionremark[<?php echo $i; ?>][remark]" ><?php echo (!empty($value->remark)) ? $value->remark : "";?></textarea></td>
                                                                      <td>
                                                                        <div class="form-group">
                                                                          <?php if (!empty($value->files)){
                                                                              $filesdata = json_decode($value->files);
                                                                              foreach ($filesdata as $k => $file) {
                                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                                if (in_array($extension, ["jpg", "png"])){
                                                                          ?>
                                                                                <a href="<?php echo base_url('uploads/design_requisition') ."/". $file; ?>" target="_blank"><img src="<?php echo base_url('uploads/design_requisition') ."/". $file; ?>" width="50px" height="50px" style="border: 1px solid;"></a>
                                                                          <?php }else{?>
                                                                                <a href="<?php echo base_url('uploads/design_requisition') ."/". $file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                                          <?php
                                                                                }
                                                                              }
                                                                          } ?>
                                                                          <input type="hidden" name="drequisitionremark[<?php echo $i; ?>][files]" value='<?php echo (isset($value->files) && !empty($value->files)) ? $value->files : ""; ?>'>
                                                                        </div>
                                                                        <input type="hidden" name="drequisitionremark[<?php echo $i; ?>][activity_id]" value="<?php echo (!empty($value->activity_id)) ? $value->activity_id : 0;?>">
                                                                      </td>
                                                                  </tr>
                                                            <?php
                                                                     $i++;
                                                                   }
                                                                }else{
                                                            ?>
                                                                  <tr class="main" id="tre<?php echo $i; ?>">
                                                                      <td><button type="button" class="btn pull-right btn-danger"  onclick="removepointerremark('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button></td>
                                                                      <td><input type="text" class="form-control" required="" name="drequisitionremark[<?php echo $i; ?>][drawing_id]" ></td>
                                                                      <td><input type="text" class="form-control" required=""name="drequisitionremark[<?php echo $i; ?>][drawing_name]" ></td>
                                                                      <td><textarea class="form-control" name="drequisitionremark[<?php echo $i; ?>][description]" ></textarea></td>
                                                                      <td><textarea class="form-control" name="drequisitionremark[<?php echo $i; ?>][remark]"></textarea></td>
                                                                      <td>
                                                                        <input type="file" class="form-control" name="design_requisition<?php echo $i; ?>[]" multiple="">
                                                                        <input type="hidden" name="drequisitionremark[<?php echo $i; ?>][activity_id]" value="0">
                                                                      </td>
                                                                  </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="col-xs-12">
                                                        <label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $i; ?>">Add More Remarks <i class="fa fa-plus"></i></a></label>
                                                    </div>
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
    var drtype = $(".dtype").val();
    if (drtype == 1){
        $(".staff_div").show();
        $(".client_section").hide();
    }else if(drtype == 2){
        $(".staff_div").hide();
        $(".client_section").show();
        $(".client_text").click();
    }
    $(document).on("change", "#type", function(){
        var type = $(this).val();
        if (type == 1){
            $(".staff_div").show();
            $(".client_section").hide();
        }else if(type == 2){
            $(".staff_div").hide();
            $(".client_section").show();
            $(".client_text").click();
        }else{
           $(".staff_div").hide();
           $(".client_section").hide();
        }
    });
    $(document).on("click", ".client_text", function(){
        var id = parseInt($(this).attr('value'));
        if(id == 1){
            $(this).attr('value', "2");
            $(this).html("Enter Client Name");
            var client_div = '<select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id"><option value=""></option><?php
            if (isset($client_branch_data) && count($client_branch_data) > 0) {
                foreach ($client_branch_data as $client_branch_key => $client_branch_value){
                    echo '<option value="'.$client_branch_value->userid.'">'.cc($client_branch_value->client_branch_name).' - '.$client_branch_value->email_id.'</option>';
                }
            }

            ?></select>';
            $(".client_div").html(client_div);
            $('.selectpicker').selectpicker('refresh');
        }else{
            $(this).attr('value', "1");
            $(this).html("Select Client");
            var client_div = '<input type="text" id="client_name" class="form-control" value="" name="client_name" placeholder="client name">';
            $(".client_div").html(client_div);
        }
    });

    $(document).on("click", ".addmoreproenq",function(){

        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);

        $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removepointerremark('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><input type="text" class="form-control" required="" name="drequisitionremark['+newaddmoreproenq+'][drawing_id]" ></td><td><input type="text" class="form-control" required=""name="drequisitionremark['+newaddmoreproenq+'][drawing_name]" ></td><td><textarea class="form-control" name="drequisitionremark['+newaddmoreproenq+'][description]" ></textarea></td><td><textarea class="form-control" name="drequisitionremark['+newaddmoreproenq+'][remark]"></textarea></td><td><input type="file" class="form-control" name="design_requisition'+newaddmoreproenq+'[]" multiple=""><input type="hidden" name="drequisitionremark['+newaddmoreproenq+'][activity_id]" value="0"></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    function removepointerremark(proid)
    {
        $('#tre' + proid).remove();
    }
</script>
</body>

</html>
