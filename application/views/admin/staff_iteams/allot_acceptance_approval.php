<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'allot-item-form', 'class' => '_item_form allot-item-form')); ?>
            <input type="hidden" value="<?php echo $id?>" name="allot_id">
            <input type="hidden" value="<?php echo $staff_id?>" name="staff_id">
            <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                      <?php if(!empty($info)){ 
                         $iteam_name = $this->db->query("SELECT * FROM `tblproducts` where id = '".$info->item_id."' ")->row();

                        ?>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">Staff Iteams</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $iteam_name->name; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $iteam_name->id; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo _d($info->date); ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="remark" class="control-label">Alloted Type</label>
                                <input type="text" readonly="" class="form-control" value="<?php if($info->remark == 1){ echo "Returnable"; } else { echo "Non Returnable"; } ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Description</label>
                                <textarea id="description" style="height: 110px;" name="description" readonly="" class="form-control"><?php echo (isset($info->description) && $info->description != "") ? $info->description : "" ?></textarea>
                            </div>
                        </div>
                        
                        <?php if(!empty($image)){ ?>
                        <div class="col-md-12">
                                <label for="name" class="control-label">Iteam Image</label>
                                  <div class="form-group">
                                  <img src="<?php echo base_url('uploads/product/') .$image->photo ?>" style="width: 150px; height: 150px;">  
                                  </div>
                        </div>
                    <?php } } ?>
                    </div>

                    <?php 
                        if(empty($appvoal_info)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                 <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Not Received
                                </button>


                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Received
                                </button>
                            </div> 
                           <?php 
                        }
                        ?>
                </div>
            </div>
        </div>   
           

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                               
                                     <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                    </div>
                                    </div>
                                </div>
                                </div>
                           
                        </div>

                    </div>


                </div>
            </div>  
           

            

            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


</body>
</html>
