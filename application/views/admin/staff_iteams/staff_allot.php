<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

         <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'staff_allot-form', 'class' => 'staff_allot-form')); ?>
         <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="staff_id" class="control-label">Employee Name</label>
                                <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($staff_list)){
                                        foreach($staff_list as $staff){
                                            ?>
                                            <option value="<?php echo $staff->staffid;?>" <?php if(!empty($staff_id) && $staff_id == $staff->staffid){ echo 'selected';} ?>><?php echo cc($staff->firstname); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="control-label">Assigned</label>
                                    <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">



                                                <?php

                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {

                                                        ?>

                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                            <?php

                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {

                                                                ?>

                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php

                                                                if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

                                                                    echo'selected';

                                                                }

                                                                ?>><?php echo $singstaff['firstname'] ?></option>

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
                                <label for="color" class="control-label">Staff Iteams</label>
                                <?php if(!empty($staff_allot)) {  
                                 $product = $this->db->query("SELECT * FROM `tblproducts` where  (is_allotted = '0' || is_allotted = '2') and status = '1' ")->result_array();
                                    ?>
                                <select class="form-control selectpicker" data-live-search="true" id="item_id" name="item_id">
                                <option value=""></option>
                                <?php
                                foreach ($product as $product_key => $product_value) {
                                ?>
                                    <option value="<?php echo $product_value['id'] ?>" <?php echo (isset($staff_allot['item_id']) && $staff_allot['item_id']==$product_value['id']) ? 'selected' : "" ?>><?php echo $product_value['name'] ?>
                                    </option>
                                <?php
                                  }
                                ?>
                                </select>
                                <?php } else { 
                                 $product = $this->db->query("SELECT * FROM `tblproducts` where  is_allotted = '0' and status = '1' ")->result_array();
                                 ?>
                                 <select class="form-control selectpicker" data-live-search="true" id="item_id" name="item_id">
                                <option value=""></option>
                                <?php
                                foreach ($product as $product_key => $product_value) {
                                ?>
                                    <option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?>
                                    </option>
                                    <?php
                                }
                                
                                ?>
                                </select>
                                <?php } ?>
                               <input type="hidden" name="product_id" class="form-control" value="<?php echo (isset($staff_allot['item_id']) && $staff_allot['item_id'] != "") ? $staff_allot['item_id'] : ''; ?>"> 
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remark" class="control-label">Alloted Type</label>
                                <select class="form-control selectpicker" name="remark" required="">
                                    <option value=""></option>
                                    <option value="1" <?php echo (isset($staff_allot['remark']) && $staff_allot['remark'] == 1) ? 'selected' : "" ?>>Returnable</option>
                                    <option value="2" <?php echo (isset($staff_allot['remark']) && $staff_allot['remark'] == 2) ? 'selected' : "" ?>>Non Returnable</option>remark
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6" app-field-wrapper="date">
                            <label for="date" class="control-label">Date</label>
                            <div class="input-group date">
                                <input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($staff_allot['date']) && $staff_allot['date'] != "") ? $staff_allot['date'] : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">Description</label>
                                <textarea id="description" style="height: 110px;" name="description" class="form-control"><?php echo (isset($staff_allot['description']) && $staff_allot['description'] != "") ? $staff_allot['description'] : "" ?></textarea>
                                <input type="hidden" name="item_ids" class="form-control" value="<?php echo (isset($staff_allot['id']) && $staff_allot['id'] != "") ? $staff_allot['id'] : ''; ?>">
                            </div>
                        </div>

                    </div>

                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit">
                            <?php echo 'Submit'; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div> 
        <?php echo form_close(); ?>

    </div>
    <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>

</body>
</html>
