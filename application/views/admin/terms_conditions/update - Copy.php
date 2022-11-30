<?php init_head(); ?>
<style>
    
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

            <form  action="<?php admin_url('terms_conditions/update'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <?php
                    if($termscondition_info->for == 1){
                        $for = 'Rent';
                    }elseif($termscondition_info->for == 2){
                        $for = 'Sales';
                    }else{
                        $for = '--';
                    }

                    if($termscondition_info->type == 1){
                        $type = 'Scaffold';
                    }elseif($termscondition_info->type == 2){
                        $type = 'Boom Lift';
                    }else{
                        $type = '--';
                    }
                    ?>

                        <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label"><?php echo 'Title'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" readonly="" value="<?php echo (isset($termscondition_info->name) && $termscondition_info->name != "") ? $termscondition_info->name : "" ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label"><?php echo 'For'; ?> </label>
                                    <input type="text" id="name" name="name" class="form-control" readonly="" value="<?php echo $for; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label"><?php echo 'Title'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" readonly="" value="<?php echo $type; ?>">
                                </div>


								                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Terms Conditions </label>
                                    <!-- <textarea id="terms_conditions" name="terms_conditions" class="form-control tinymce"><?php echo (isset($termscondition_info->terms_conditions) && $termscondition_info->terms_conditions != "") ? $termscondition_info->terms_conditions : "" ?></textarea> -->
                                    <div class="row">
                                        <div class="termscondition_div">
                                          <?php
                                              if (isset($termsconditionpointers) && !empty($termsconditionpointers)){
                                                 foreach ($termsconditionpointers as $key => $value) {
                                          ?>
                                                    <div class="condition<?php echo $key; ?>">
                                                      <div class="form-group col-md-11">
                                                          <input type="text" name="termscondition[<?php echo $key; ?>][condition]" class="form-control" value="<?php echo $value->condition; ?>">
                                                      </div>
                                                      <div class="form-group col-md-1"><a href="javascript:void(0);" onclick="removecondition(<?php echo $key; ?>);" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>
                                                    </div>
                                          <?php
                                                 }
                                              }else{
                                          ?>
                                          <div class="condition0">
                                            <div class="form-group col-md-11">
                                                <input type="text" name="termscondition[0][condition]" class="form-control" value="">
                                            </div>
                                          </div>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="addmoreproenq" value="<?php echo (isset($termsconditionpointers) && !empty($termsconditionpointers)) ? count($termsconditionpointers) : 0; ?>"><i class="fa fa-plus"> Add More</i></a>
                                </div>
                        </div>

                        <input type="hidden" value="<?php echo $termscondition_info->id; ?>" name="id">

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

    $(".addmoreproenq").click(function(){
        var number = parseInt($(this).attr('value'));
        var new_row = number+1;
        $(this).attr('value', new_row);
        $(".termscondition_div").append('<div class="condition'+new_row+'"><div class="form-group col-md-11"><input type="text" name="termscondition['+new_row+'][condition]" class="form-control" value=""></div><div class="form-group col-md-1"><a href="javascript:void(0);" onclick="removecondition('+new_row+');" class="btn btn-danger"><i class="fa fa-trash"></i></a></div></div>');
    });

    function removecondition(row_id){
        $('.condition' + row_id).remove();
    }
</script>





</body>
</html>
