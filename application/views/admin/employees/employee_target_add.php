<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
            </div>
            <!--      <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
                     <button class="btn btn-info only-save customer-form-submiter">Save</button>
                  </div>-->
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div>
                            <div class="tab-content">
                                <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title : ""; ?></h4>
                                <?php //echo form_open($this->uri->uri_string(), array('id' => 'enquirycall-form', 'class' => 'enquirycall-form')); ?>
                                <form action="" id="employee-target" class="employee-target" method="post" accept-charset="utf-8" >
                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Employee Name</label>
                                                    <select class="form-control selectpicker" required="" name="staff_id" id="staff_id" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                            if (!empty($sales_person_info)) {
                                                                foreach ($sales_person_info as $row) {
                                                                    $selected = (isset($employee_target) && $row->sales_person_id == $employee_target->staff_id) ? "selected" : "";
                                                        ?>
                                                                    <option value="<?php echo $row->sales_person_id; ?>" <?php echo $selected; ?> ><?php echo cc(get_employee_name($row->sales_person_id)); ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Division</label>
                                                    <select class="form-control selectpicker" required="" name="product_category_id" id="product_category_id" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($divisionmaster_list) && count($divisionmaster_list) > 0) {
                                                            foreach ($divisionmaster_list as $value) {
                                                                $selected = (isset($employee_target) && $value->id == $employee_target->product_category_id) ? "selected" : "";
                                                                ?>
                                                                <option value="<?php echo $value->id ?>" <?php echo $selected; ?>><?php echo cc($value->title); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="amount" class="control-label">Target Amount</label>
                                                    <input type="text" id="amount" required="" class="form-control amount" value="<?php echo (isset($employee_target)) ? $employee_target->amount : ""; ?>" name="amount" placeholder="amount">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="remark" class="control-label">Remark</label>
                                                    <textarea id="remark" rows="5" name="remark" required="" class="form-control" placeholder="remark..."><?php echo (isset($employee_target)) ? $employee_target->remark : ""; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="btn-bottom-toolbar text-right">
                                            
                                        <button class="btn btn-info" type="submit">
                                        <?php echo _l('submit'); ?>
                                        </button>
                                    </div>
                                            <?php //echo form_close();  ?>
                                </form>
                            </div>
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

    $('.amount').keypress(function(event) {

      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {

        event.preventDefault();

      }

    });

</script>

</body>
</html>
