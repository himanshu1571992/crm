<div class="row">
    <br>  
    <div class="termscondition_div">
      <?php
              if (!empty($condition_list)){
                  foreach ($condition_list as $key => $value) {
      ?>
                    <div class="condition<?php echo $key; ?>">
                      <div class="form-group col-md-11">
                          <input type="text" name="termscondition[<?php echo $key; ?>][condition]" class="form-control" value="<?php echo $value->condition; ?>">
                      </div>
                      <div class="form-group col-md-1"><a href="javascript:void(0);" onclick="removecondition(<?php echo $key; ?>);" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>
                    </div>
      <?php
                  }
              }
      ?>
    </div>
    <a href="javascript:void(0);" class="addmorecondition col-xs-4" value="<?php echo (isset($condition_list) && !empty($condition_list)) ? count($condition_list) : 0; ?>"><i class="fa fa-plus"> Add More</i></a>
</div>

<script type="text/javascript">
    $(".addmorecondition").click(function(){
        var number = parseInt($(this).attr('value'));
        var new_row = number+1;
        $(this).attr('value', new_row);
        $(".termscondition_div").append('<div class="condition'+new_row+'"><div class="form-group col-md-11"><input type="text" name="termscondition['+new_row+'][condition]" class="form-control" value=""></div><div class="form-group col-md-1"><a href="javascript:void(0);" onclick="removecondition('+new_row+');" class="btn btn-danger"><i class="fa fa-trash"></i></a></div></div>');
    });
    function removecondition(row_id){
        $('.condition' + row_id).remove();
    }
</script>
