<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'lead_staff-form', 'class' => 'lead_staff-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Group Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (!empty($lead_staff_info)) ? $lead_staff_info['name'] : ""; ?>">
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="superior_ids" class="control-label">Superior Person <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="superior_ids[]" id="superior_ids" multiple data-live-search="true" required="">
                                        <option value=""></option>
                                        <?php
                                 
                                        if (isset($employee_info) && count($employee_info) > 0) {
                                            foreach ($employee_info as $value) {

                                                ?>
                                                <option value="<?php echo $value['staffid'] ?>" <?php echo (isset($superiordata) && in_array($value['staffid'],$superiordata) ) ? 'selected' : "" ?>><?php echo cc($value['firstname']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sales_person_id" class="control-label">Sales Person <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="sales_person_id" id="sales_person_id" data-live-search="true" required="">
                                        <option value=""></option>
                                        <?php
                                 
                                        if (isset($employee_info) && count($employee_info) > 0) {
                                            foreach ($employee_info as $value) {

                                                ?>
                                                <option value="<?php echo $value['staffid'] ?>" <?php echo (isset($lead_staff_info) && $lead_staff_info['sales_person_id'] == $value['staffid']) ? 'selected' : "" ?>><?php echo cc($value['firstname']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quote_person_ids" class="control-label">Quote Person <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="quote_person_ids[]" id="quote_person_ids" multiple data-live-search="true" required="">
                                        <option value=""></option>
                                        <?php
                                 
                                        if (isset($employee_info) && count($employee_info) > 0) {
                                            foreach ($employee_info as $value) {

                                                ?>
                                                <option value="<?php echo $value['staffid'] ?>" <?php echo (isset($quotedata) && in_array($value['staffid'],$quotedata) ) ? 'selected' : "" ?>><?php echo cc($value['firstname']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
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


<script type="text/javascript">

    $(function () {

        $('#color-group').colorpicker({horizontal: true});

    });

$(document).on('change', '#type', function() {   

       var type = $(this).val(); 

       if(type == 3 || type == 4){

            $('#options').show();

       }else{

            $('#options').hide();

       }



    });
</script>

</body>

</html>

