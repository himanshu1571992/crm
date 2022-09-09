<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3>Product Details</h3>
                                <hr/>
                            </div>

                            <?php
                         if(!empty($products_log)){
                         foreach ($products_log as $value) { 

                            if(!empty($value->product_cat_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductcategory',$value->product_cat_id,'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                           if(!empty($value->product_sub_cat_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_sub_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductsubcategory',$value->product_sub_cat_id,'name'); ?>">
                                    </div>
                                </div>
                                <?php
                           }

                            if(!empty($value->parent_category_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Parent Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductparentcategory',$value->parent_category_id,'name'); ?>">
                                    </div>
                                </div>
                                <?php
                           }

                             if(!empty($value->child_category_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Child Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductchildcategory',$value->child_category_id,'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($value->name)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_name'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $value->name; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($value->sub_name)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo 'Print Name'; ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $value->sub_name; ?>">
                                    </div>
                                </div>
                                <?php
                           }
                        }
                    }

                            ?>


                         <div class="col-md-12">
                                <h3>Custom Product Fields</h3>
                                <hr/>
                          </div> 
                        
                          <?php
                          if(!empty($field_info) && !empty($productsfield_log))
                             {
                               $html = '';
                                        foreach ($field_info as $row) {
                                            $required = "";
                                            $require_html = "";
                                            if($row->required == 1){
                                                $required = "required";
                                                $require_html = "<span style=\"color: red;\">*</span>";
                                            }
                                           // foreach ($products_log as $product_id) {
                                            $custom_value = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`='".$product['id']."' and field_id = '".$row->field_id."' ")->row()->field_value;
                                            if($row->type == 1){                            
                                                $html .= '<div class="form-group col-md-'.$row->size.'">
                                                        <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.' </label>
                                                        <input type="text" id="'.$row->field_id.'" value="'.$custom_value.'" disabled name="fielddata['.$row->field_id.']" '.$required.' class="form-control" value="">
                                                    </div>';
                                            }else{
                                                $html .= '<div class="form-group col-md-'.$row->size.'" >
                                                        <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                                        <textarea id="'.$row->field_id.'" disabled name="fielddata['.$row->field_id.']" '.$required.' class="form-control">'.$custom_value.'</textarea>
                                                    </div>';
                                            }
                                       // }
                                    }
                                        echo $html;
                            
                            
                             }
                              ?>

                        <div class="col-md-12"><h3>Other Product Information</h3><hr/></div>
                        <?php foreach ($products_log as $other_product) { ?>
                                <div class="form-group col-md-3">
                                    <label for="unit_id" class="control-label"><?php echo _l('product_unit'); ?></label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tblunitmaster` where id = '".$other_product->unit_id."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo $product_unit->name; ?>">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="gst_id" class="control-label">GST Percent</label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tbltaxes` where id = '".$other_product->gst_id."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo $product_unit->name.' ('.$product_unit->taxrate.')'; ?>">
                                </div>

                              

                                <div class="form-group col-md-3">
                                    <label for="isOtherCharge" class="control-label">Is Other Charges</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="isOtherCharge" name="isOtherCharge" disabled="">
                                        <option value="0" <?php echo (isset($other_product->isOtherCharge) && $other_product->isOtherCharge == 0) ? 'selected' : "" ?>>No</option>
                                        <option value="1" <?php echo (isset($other_product->isOtherCharge) && $other_product->isOtherCharge == 1) ? 'selected' : "" ?>>Yes</option>
                                       
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label"><?php echo _l('product_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="" disabled="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($other_product->status) && $other_product->status == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($other_product->status) && $other_product->status == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div> 
                        <?php } 

                        if(!empty($value->photo)){
                        ?>
                        <div class="col-md-12"><h3>Product Main Image</h3><hr/></div>
                        <img src="<?php echo base_url('uploads/product') . "/" . $value->photo; ?>" class="image-responsive" style="height: 100px; width : 100px;" alt="" />
                        <?php    
                        }
                        if(!empty($multiple_images)){
                            echo '<div class="col-md-12"><h3>Product Sub Images</h3><hr/></div><div class="table-responsive s_table">';
                            foreach ($multiple_images as  $r1) {
                                ?>
                                <img src="<?php echo base_url('uploads/product/product_multiple') . "/" . $r1->file_name; ?>" class="image-responsive" style="height: 100px; width : 100px;" alt="" />
                                <?php
                            }
                            echo '</div>';
                        }
                        if(!empty($product_drawing)){
                            ?>
                            <div class="col-md-12"><h3>Product Drawings</h3><hr/></div>
                            <div class="table-responsive s_table">
                            <?php
                            foreach ($product_drawing as  $r2) {
                                ?>
                                <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $r2->file_name; ?>" download=""><?php echo $r2->file_name; ?></a><br>
                                <?php
                            }
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                        



                        <div class="col-md-12"><h3>Add Iteams</h3><hr/></div>
                        <div class="table-responsive s_table">
                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="5%"  align="center">S.No.</th>
                                            <th width="50%" align="left">Item Name</th>
                                            <!-- <th width="5%" align="left">view</th> -->
                                            <th width="20%" class="qty" align="left">Qty</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (!empty($productsitems_log)) {
                                            $i = 0;
                                            foreach ($productsitems_log  as $key => $value) {
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>  
                                                    <td><?php echo value_by_id('tblproducts',$value->item_id,'name').product_code($value->item_id); ?></td>
                                                    <!-- <td><a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$value->item_id); ?>">View</a></td> -->
                                                    <td><?php echo $value->qty; ?></td>  
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else{
                                           ?>
                                           <tr>
                                                <td colspan="4">Items Not Available</td>
                                           </tr>
                                           <?php     
                                        } 
                                            ?>
                                            
                                    </tbody>
                                </table>

                                
                               
                                <div class="col-md-12">
                                        <h3>Product FAQ</h3>
                                        <hr/>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">FAQ</label>
                                        <?php foreach ($products_log as $faq) { ?>
                                        <textarea disabled="" class="form-control"><?php echo $faq->faq; ?></textarea>
                                        <?php } ?>
                                    </div>
                                </div>
                                

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

<script>
    init_selectpicker();
</script>

</body>
</html>
