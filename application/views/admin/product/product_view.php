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
                                <h3>Prodcut Details</h3>
                                <hr/>
                            </div>

                            <?php
                            if(!empty($product['product_cat_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductcategory',$product['product_cat_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['product_sub_cat_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_sub_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductsubcategory',$product['product_sub_cat_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['parent_category_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Parent Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductparentcategory',$product['parent_category_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['child_category_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Child Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductchildcategory',$product['child_category_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['name'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_name'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['name']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['sub_name'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo 'Print Name'; ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sub_name']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['company_product_code'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Company Product Code</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['company_product_code']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['product_description'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo _l('product_description'); ?></label>
                                        <textarea disabled="" class="form-control"><?php echo $product['product_description']; ?></textarea>
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['unit_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('unit'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblunitmaster',$product['unit_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['working_height'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_working_height'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['working_height']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['platform_height'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_platform_height'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['platform_height']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['tower_height'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_tower_height'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['tower_height']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['dimensions'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_dimensions'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['dimensions']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['gst_id'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_gst'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tbltaxes',$product['gst_id'],'name'); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['hsn_code'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_hsn_code'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['hsn_code']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['sac_code'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_sac_code'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sac_code']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['product_weight'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_weight'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['product_weight']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['purchase_price'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_purchase_price'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['purchase_price']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['product_remarks'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo _l('product_remarks'); ?></label>
                                        <textarea disabled="" class="form-control"><?php echo $product['product_remarks']; ?></textarea>
                                    </div>
                                </div>
                                <?php
                            }

                             if (isset($product['photo']) && $product['photo'] != "") {
                                    ?>
                                    <div class="form-group proimg">
                                        <label class="control-label"></label>
                                        <img src="<?php echo base_url('uploads/product') . "/" . $product['photo'] ?>" style="width: 150px; height: 150px;">
                                        <!-- <a class="removeimg" value="<?php echo $product['id']; ?>">Remove Image <i class="fa fa-remove"></i></a> -->
                                    </div>
                                    <?php
                                }
                            ?>


                         <div class="col-md-12">
                                <h3>Product Price Details</h3>
                                <hr/>
                          </div> 

                          <?php

                            if(!empty($product['sale_price_cat_a'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_sale_cat_a'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sale_price_cat_a']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($product['rental_price_cat_a'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_rental_cat_a'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['rental_price_cat_a']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['sale_price_cat_b'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_sale_cat_b'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sale_price_cat_b']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['rental_price_cat_b'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_rental_cat_b'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['rental_price_cat_b']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['sale_price_cat_c'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_sale_cat_c'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sale_price_cat_c']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['rental_price_cat_c'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_rental_cat_c'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['rental_price_cat_c']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['sale_price_cat_d'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_sale_cat_d'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['sale_price_cat_d']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['rental_price_cat_d'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_add_rental_cat_d'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['rental_price_cat_d']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['damage_rate'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('component_damage_rate'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['damage_rate']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['lost_rate'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('component_lost_rate'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['lost_rate']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                             if(!empty($product['repairable_rate'])){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('component_repairable_rate'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo $product['repairable_rate']; ?>">
                                    </div>
                                </div>
                                <?php
                            }

                          ?>     

                          <?php
                          if(!empty($item_info)){
                          ?>  
                          <div class="col-md-12">
                                <h3>Item List</h3>
                                <hr/>
                          </div>


                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                           <th width="5%"  align="center">S.No.</th> 
                                           <th width="50%" align="left">Item Name</th>
                                            <th width="5%" align="left">view</th>
                                            <th width="20%" class="qty" align="left">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if(!empty($item_info)){
                                            foreach ($item_info as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>  
                                                    <td><?php echo value_by_id('tblproducts',$value->item_id,'name').product_code($value->item_id); ?></td>
                                                    <td><a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$value->item_id); ?>">View</a></td>
                                                    <td><?php echo $value->qty; ?></td>  
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                           ?>
                                           <tr>
                                                <td colspan="4">Items Not Available</td>
                                           </tr>
                                           <?php     
                                        }

                                        ?>
                                    </tbody>
                                     
                                </table>

                            </div> 

                            <?php
                            }
                            ?>      

                        <?php
                        if(!empty($product['faq'])){
                                ?>
                                <div class="col-md-12">
                                        <h3>Product FAQ</h3>
                                        <hr/>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">FAQ</label>
                                        <textarea disabled="" class="form-control"><?php echo $product['faq']; ?></textarea>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>

                        

                        </div>
                        <?php
                            if(check_permission_page(69,'edit') ){
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            
                            <a class="btn btn-info" href="<?php echo base_url('admin/product/product/'.$product['id']); ?>">Edit Product</a>
                        </div>
                        <?php
                        }
                        ?>
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
