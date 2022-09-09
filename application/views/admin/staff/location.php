<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'product_sub_category-form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label">Location Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (!empty($location_info)) ? $location_info->name : ""; ?>">
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="control-label">Select Branch <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="branch_id" required="" id="branch_id">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($branch_info)){
                                            foreach ($branch_info as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo (isset($location_info->branch_id) && $location_info->branch_id == $value->id) ? 'selected' : "" ?>><?php echo $value->comp_branch_name; ?></option>
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

