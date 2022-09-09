<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('company_expense/edit_party'); }else{ echo admin_url('company_expense/add_party'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                
                                <div class="form-group col-md-4">
                                    <label for="category_id" class="control-label">Expense Category *</label>
                                    <select class="form-control" required="" id="category_id" name="category_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        if(!empty($category_info)){
                                            foreach ($category_info as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($party_info->category_id) && $party_info->category_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="head_id" class="control-label">Head *</label>
                                    <select class="form-control" required="" id="head_id" name="head_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        $head_data = $this->db->query("SELECT * from `tblheads` where category_id = '".$party_info->category_id."' AND status = 1 order by id desc  ")->result();
                                        if(!empty($head_data)){
                                            foreach ($head_data as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($party_info->head_id) && $party_info->head_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?> 
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="subhead_id" class="control-label">Sub Head</label>
                                    <select class="form-control" id="subhead_id" name="subhead_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        $subhead_data = $this->db->query("SELECT * from `tblsubheads` where head_id = '".$party_info->head_id."' AND status = 1 order by id desc  ")->result();
                                        if(!empty($subhead_data)){
                                            foreach ($subhead_data as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($party_info->sub_head_id) && $party_info->sub_head_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label"><?php echo 'Party Name'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($party_info->name) && $party_info->name != "") ? $party_info->name : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="bank_name" class="control-label"><?php echo 'Bank Name'; ?> </label>
                                    <input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo (isset($party_info->bank_name) && $party_info->bank_name != "") ? $party_info->bank_name : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ifsc" class="control-label"><?php echo 'Bank IFSC'; ?> </label>
                                    <input type="text" id="ifsc" name="ifsc" class="form-control" value="<?php echo (isset($party_info->ifsc) && $party_info->ifsc != "") ? $party_info->ifsc : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="account_no" class="control-label"><?php echo 'Bank A/c No.'; ?> </label>
                                    <input type="text" id="account_no" name="account_no" class="form-control" value="<?php echo (isset($party_info->account_no) && $party_info->account_no != "") ? $party_info->account_no : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gst_no" class="control-label"><?php echo 'GST No.'; ?> </label>
                                    <input type="text" id="gst_no" name="gst_no" class="form-control" value="<?php echo (isset($party_info->gst_no) && $party_info->gst_no != "") ? $party_info->gst_no : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="pan_no" class="control-label"><?php echo 'PAN No.'; ?></label>
                                    <input type="text" id="pan_no" name="pan_no" class="form-control" value="<?php echo (isset($party_info->pan_no) && $party_info->pan_no != "") ? $party_info->pan_no : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="mobile_no" class="control-label"><?php echo 'Mobile No.'; ?></label>
                                    <input type="text" maxlength="10" minlength="10" id="mobile_no" name="mobile_no" class="form-control onlynumbers1 contact1" value="<?php echo (isset($party_info->mobile_no) && $party_info->mobile_no != "") ? $party_info->mobile_no : "" ?>"><div id="phonenumberdiv1"></div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="status" class="control-label"><?php echo 'Status'; ?> *</label>
                                    <select class="form-control" required="" id="status" name="status">
                                        <option value="1" <?php if(!empty($party_info->status) && $party_info->status == 1){ echo 'selected';} ?>  >Active</option>
                                        <option value="0" <?php if(!empty($party_info->status) && $party_info->status == 0){ echo 'selected';} ?>  >Inactive</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="address" class="control-label">Address </label>
                                    <textarea id="address" name="address" class="form-control"><?php echo (isset($party_info->address) && $party_info->address != "") ? $party_info->address : "" ?></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="remark" class="control-label">Remark </label>
                                    <textarea id="remark" name="remark" class="form-control"><?php echo (isset($party_info->remark) && $party_info->remark != "") ? $party_info->remark : "" ?></textarea>
                                </div>

                              
                        </div>

                        <?php
                        if(!empty($id)){
                            ?>
                            <input type="hidden" value="<?php echo $id;?>" name="id">
                            <?php
                        }
                        ?>

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            </form>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

    $('.onlynumbers1').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });

    $(function() { 
        $('.contact1').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv1").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});

$(document).on('change', '#category_id', function() {   
       var category_id = $("#category_id").val();
           $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_head'); ?>",
                data    : {'category_id' : category_id},
                success : function(response){
                    if(response != ''){                   
                         $('#head_id').html(response);  
                         $('#subhead_id').html('<option value="">--Select One-</option>');
                    }
                }
            })    
    });

$(document).on('change', '#head_id', function() {   
       var head_id = $("#head_id").val();
           $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_subhead'); ?>",
                data    : {'head_id' : head_id},
                success : function(response){
                    if(response != ''){                   
                         $('#subhead_id').html(response);  
                    }
                }
            })    
    });
</script>





</body>
</html>
