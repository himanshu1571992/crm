
<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

?>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
            </div>
         </div>
         <?php echo vendor_report_tab('product',$vendor_info->id);?>
      </div>
         
          <form  action=""  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
             <input type="hidden" id="pid" name="pid" class="form-control"  value="<?php echo $vendor_edit_info->id;?>">
             <input type="hidden" id="vendor_id" name="vendor_id" class="form-control"  value="<?php echo $vendor_edit_info->vendor_id;?>">
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                   <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                    </div>

          <hr class="hr-panel-heading">
          
                 <div class="row">

                    <div class="form-group col-md-6">
                        <label for="branch_id" class="control-label">Select Product *</label>
                        <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id">
                            <option value="" disabled selected >--Select One-</option>
                            <?php
                            if(!empty($product_info)){
                              foreach ($product_info as $key => $value) {
                                ?>
                                
                                <option value="<?= $value->id ?>" <?php if($vendor_edit_info->product_id == $value->id) { echo "selected";}?>>
                <?=$value->name ?>
                                  </option>

                                <?php
                              }
                            }
                            ?>
                        </select>
                    </div>

                    
                    <div class="form-group col-md-6">
                        <label for="product_name" class="control-label">Vendor Product Name </label>
                        <input type="text" id="product_name" name="product_name" class="form-control"  value="<?php echo $vendor_edit_info->product_name;?>">
                    </div>   
                   </div> 
                   <div class="row">
                    <div class="form-group col-md-12">
                 <div class="form-group" app-field-wrapper="Remark"
                 ><label for="Remark" class="control-label">Remark</label><textarea id="remark" name="remark" class="form-control" rows="4"><?php echo $vendor_edit_info->remark;?></textarea>
               </div>
                </div>
              </div>
                     <div class="form-group col-md-2">
                      <button class="form-control btn-info" type="submit">Submit</button>
                    </div>



                        </div>
                        </div>
                       
                    </div>
                </div>
        </form>
   </div>
</div>
</div>

<?php init_tail(); ?>

</body>
</html>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
        <div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>


<script type="text/javascript">
  $('.status').click(function(){
  var po_id = $(this).val();
  
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
      data    : {'po_id' : po_id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
        }
      }
    })
  });
</script> 