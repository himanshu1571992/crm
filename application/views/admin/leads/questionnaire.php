<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }

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
                            
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="question" class="control-label">Questionnaire Name <span style="color: red;">*</span></label>
                                    <input type="text" id="question" name="question" class="form-control" required="" value="<?php echo (!empty($question_info)) ? $question_info->question : ""; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-2" style="margin-top: 26px;">
                                <div class="form-group">
                                    <label for="is_required" class="control-label">Required</label>
                                    <input type="checkbox" value="1" name="is_required" <?php echo (!empty($question_info) && $question_info->is_required == 1) ? 'checked' : "";?>>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="control-label">Type <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="type" required="" id="type">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($question_info->type) && $question_info->type == 1) ? 'selected' : "" ?>>Input Box</option>
                                        <option value="2" <?php echo (isset($question_info->type) && $question_info->type == 2) ? 'selected' : "" ?>>Text Box</option>
                                        <option value="3" <?php echo (isset($question_info->type) && $question_info->type == 3) ? 'selected' : "" ?>>Selection Box</option>
                                        <option value="4" <?php echo (isset($question_info->type) && $question_info->type == 4) ? 'selected' : "" ?>>Multi-Selection Box</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="question_order">
                                    <label for="question_order" class="control-label">Order<span style="color: red;">*</span></label>
                                    <input type="number" required="" id="question_order" name="question_order" class="form-control" value="<?php echo (!empty($question_info)) ? $question_info->question_order : "";?>">
                                </div>                                        
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="size">
                                    <label for="size" class="control-label">Questionnaire Size<span style="color: red;">*</span></label>
                                    <input type="number" required="" max="12" id="size" name="size" class="form-control" value="<?php echo (!empty($question_info)) ? $question_info->size : "";?>">
                                </div>                                        
                            </div>
                            <?php 
                            if((!empty($question_info))) {
                            if($question_info->type == 3 || $question_info->type == 4) { ?>
                            <div class="col-md-12" id="options">
                                <div class="form-group">
                                    <label for="options" class="control-label">Option</label>
                                    <textarea style="height: 110px;" name="options" class="form-control"><?php echo (isset($question_info->options) && $question_info->options != "") ? $question_info->options : "" ?></textarea>
                                </div>
                            </div>
                            <?php } else { ?> 
                            <div class="col-md-12" id="options" hidden>
                                <div class="form-group">
                                    <label for="options" class="control-label">Option</label>
                                    <textarea style="height: 110px;" name="options" class="form-control"></textarea>
                                </div>
                            </div>
                            <?php  } } else {  ?>

                            <div class="col-md-12" id="options" hidden>
                                <div class="form-group">
                                    <label for="options" class="control-label">Option</label>
                                    <textarea style="height: 110px;" name="options" class="form-control"></textarea>
                                </div>
                            </div><?php } ?>



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

