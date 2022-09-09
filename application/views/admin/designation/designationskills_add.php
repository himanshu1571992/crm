<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
               <div>
                  <div class="tab-content">
                      <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?></h4>
                      <?php echo form_open($this->uri->uri_string(), array('id' => 'designationquestion-form', 'class' => 'designationquestion-form')); ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="designation" class="control-label">Designation <span style="color: red;">*</span></label>
                                        <select class="form-control selectpicker" id="designation_id" multiple="" name="designation_id[]" required="" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($designation_list){
                                                    foreach ($designation_list as $value) {
                                                        $dlist = (!empty($designationskill_info)) ? explode(",", $designationskill_info->designation_ids) : [];
                                                        $selected = (in_array($value->id, $dlist)) ? "selected='selected'":"";
                                                        echo '<option value="'.$value->id.'" '.$selected.'>'.$value->designation.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="remark" class="control-label">Remark</label>
                                        <textarea id="remark" name="remark" rows="3" class="form-control" placeholder="remark..."><?php echo (!empty($designationskill_info)) ? $designationskill_info->remark: ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <h3>Designation Skills</h3>
                                <hr>
                                <div class="col-md-12">
                                    <div class="row pro_enq_details">
                                        <div class="table-responsive s_table">
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                                <thead>
                                                    <tr>
                                                        <th width="1%"  align="center"><i class="fa fa-cog"></i></th>
                                                        <th width="30%" align="left">Skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ui-sortable">
                                                    <?php
                                                        $i = 0;
                                                        if(!empty($skill_details)){
                                                            foreach ($skill_details as $value) {
                                                                $i++;
                                                    ?>
                                                                <tr class="main" id="tre<?php echo $i; ?>">
                                                                    <td><button type="button" class="btn pull-right btn-danger"  onclick="removeskill('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button></td>
                                                                    <td><textarea id="skill" name="skill[<?php echo $i; ?>]" class="form-control" placeholder="skill..."><?php echo $value->skills ?></textarea></td>
                                                                </tr>
                                                    <?php
                                                            }
                                                        }
                                                    ?>

                                                </tbody>
                                            </table>
                                            <div class="col-xs-12">
                                                <label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $i; ?>">Add More skill <i class="fa fa-plus"></i></a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit"><?php echo _l('submit'); ?></button>
                        </div>
                      <?php echo form_close(); ?>
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


    $(document).on("click", ".addmoreproenq",function(){
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);
        $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeskill('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><textarea id="skill" name="skill['+newaddmoreproenq+']" class="form-control" placeholder="skill..."></textarea></td></tr>');
    });

    function removeskill(proid)
    {
        $('#tre' + proid).remove();
    }

</script>
</body>
</html>
