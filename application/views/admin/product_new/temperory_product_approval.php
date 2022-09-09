<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'temperory_product-form', 'class' => 'temperory_product-form')); ?>
            
            <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                      <?php if(!empty($info)){ 
                         $category_name = $this->db->query("SELECT * FROM `tblproductcategory` where id ='".$info->category_id."' ")->row();

                        ?>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">Category Name</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $category_name->name; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $category_name->id; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Product Name</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo (isset($info->product_name) && $info->product_name != "") ? $info->product_name : "" ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">SAC Code</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo (isset($info->sac) && $info->sac != "") ? $info->sac : "" ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">HSN Code</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo (isset($info->hsn) && $info->hsn != "") ? $info->hsn : "" ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Unit</label>
                                <?php 
                                $unit_name = $this->db->query("SELECT * FROM `tblunitmaster` where id ='".$info->unit."' ")->row(); 
                                ?>
                                <input type="text" readonly="" class="form-control" value="<?php echo (isset($unit_name->name) && $unit_name->name != "") ? $unit_name->name : "" ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">Product Price</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo (isset($info->price) && $info->price != "") ? $info->price : "" ?>">
                            </div>
                        </div>

                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Product Description</label>
                                <textarea id="description" style="height: 110px;" name="description" readonly="" class="form-control"><?php echo (isset($info->product_desc) && $info->product_desc != "") ? $info->product_desc : "" ?></textarea>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo _d($info->created_at); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <div class="form-group">
                            <label for="date" class="control-label">Drawing Image</label><br>
                            <a target="_blank" href="<?php echo base_url('uploads/temperory_product/'.$info->id.'/'.$info->file_name); ?>"><?php echo $info->file_name; ?>
                                    </a>
                            </div>
                        </div>
                        
                        
                    <?php  } ?>
                    </div>

                    <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">
                                    On Hold
                                </button>
                                <button type="submit" name="submit" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">
                                    Reconciliation
                                </button>
                                 <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approved
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
