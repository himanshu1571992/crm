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

                            if(!empty($products_log->product_cat_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo cc(value_by_id('tblproductcategory',$products_log->product_cat_id,'name')); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                           if(!empty($products_log->product_sub_cat_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_sub_cat'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo cc(value_by_id('tblproductsubcategory',$products_log->product_sub_cat_id,'name')); ?>">
                                    </div>
                                </div>
                                <?php
                           }

                           if(!empty($products_log->parent_category_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Parent Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo cc(value_by_id('tblproductparentcategory',$products_log->parent_category_id,'name')); ?>">
                                    </div>
                                </div>
                                <?php
                           }

                             if(!empty($products_log->child_category_id)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Product Child Category</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo cc(value_by_id('tblproductchildcategory',$products_log->child_category_id,'name')); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if($products_log->division_id > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Division</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id("tbldivisionmaster", $products_log->division_id, "title"); ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if($products_log->sub_division_id > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label">Sub Division</label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id("tblsubdivisionmaster", $products_log->sub_division_id, "title"); ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if(!empty($products_log->name)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo _l('product_name'); ?></label>
                                            <input type="text"  disabled="" class="form-control" value="<?php echo cc($products_log->name); ?>">
                                    </div>
                                </div>
                                <?php
                            }

                            if(!empty($products_log->sub_name)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label"><?php echo 'Print Name'; ?></label>
                                            <input type="text"  disabled="" class="form-control" value='<?php echo cc($products_log->sub_name); ?>'>
                                    </div>
                                </div>
                                <?php
                           }?>
                           <div class="col-md-12">
                                <h3>Printing Details</h3>
                                <hr/>
                          </div>
                        <?php  
                           if($products_log->print_thickness > 0){
                         ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Thickness</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_thickness; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if($products_log->print_diameter > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Diameter</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_diameter; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if($products_log->print_width > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Width</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_width; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if($products_log->print_height > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Height</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_height; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if($products_log->print_length > 0){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Length</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_length; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            if(!empty($products_log->print_range)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Range</label>
                                        <input type="text" disabled="" class="form-control" value='<?php echo $products_log->print_range; ?>'>
                                    </div>
                                </div>
                                <?php
                            }
                            if(!empty($products_log->print_capacity)){
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Capacity</label>
                                        <input type="text"  disabled="" class="form-control" value="<?php echo $products_log->print_capacity; ?>">
                                    </div>
                                </div>
                                <?php
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
                                <div class="form-group col-md-2">
                                    <label for="unit_id" class="control-label"><?php echo _l('product_unit'); ?></label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tblunitmaster` where id = '".$products_log->unit_id."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo $product_unit->name; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                        <label for="productname" class="control-label">Size</label>
                                        <input type="text" id="productname" name="size" disabled="" class="form-control" value="<?php echo $products_log->size; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="unit_id" class="control-label">Unit 1</label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tblunitmaster` where id = '".$products_log->unit_1."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo (!empty($product_unit)) ? $product_unit->name : ''; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                        <label for="productname" class="control-label">Conversion 1</label>
                                        <input type="text" id="productname" disabled="" name="size" class="form-control" value="<?php echo $products_log->conversion_1; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="unit_id" class="control-label">Unit 2</label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tblunitmaster` where id = '".$products_log->unit_2."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo (!empty($product_unit)) ? $product_unit->name : ''; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                        <label for="productname" class="control-label">Conversion 2</label>
                                        <input type="text" id="productname" disabled="" name="size" class="form-control" value="<?php echo $products_log->conversion_2; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="min_qty" class="control-label">Min Quantity</label>
                                        <input type="text" id="min_qty" disabled="" name="min_qty" class="form-control" value="<?php echo $products_log->min_qty; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="max_qty" class="control-label">Max Quantity</label>
                                        <input type="text" id="max_qty" disabled="" name="max_qty" class="form-control" value="<?php echo $products_log->max_qty; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                        <label for="productname" class="control-label">Sales Price *</label>
                                        <input type="text" id="productname" disabled="" name="size" class="form-control" value="<?php echo $products_log->price; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="gst_id" class="control-label">GST Percent</label>
                                    <?php

                                    $product_unit = $this->db->query("SELECT * FROM `tbltaxes` where id = '".$products_log->gst_id."' ")->row(); ?>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo $product_unit->name.' ('.$product_unit->taxrate.')'; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="gst_id" class="control-label">Product Master</label>
                                    <input type="text"  disabled="" class="form-control" value="<?php echo value_by_id('tblproductnewmaster',$products_log->master_id,'name'); ?>">
                                </div>



                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label"><?php echo _l('product_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="" disabled="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($products_log->status) && $products_log->status == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($products_log->status) && $products_log->status == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label">Product Material</label>
                                <select class="form-control selectpicker productmaterial_id" disabled="" data-live-search="true" name="productmaterial_id">
                                    <option value=""></option>
                                    <?php
                                        if (!empty($productmaterial_list)){
                                            foreach ($productmaterial_list as $vlist) {
                                                $selected = (isset($products_log->productmaterial_id) && $products_log->productmaterial_id == $vlist->id) ? 'selected' : "";
                                                echo '<option value="'.$vlist->id.'" '.$selected.'>'.cc($vlist->name).'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php  if($products_log->width_mm > 0){ ?>
                                <div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Width (MM) *</label>
                                    <input type="text" id="width_mm" name="width_mm" readonly="" class="form-control" value="<?php echo (isset($products_log->width_mm) && $products_log->width_mm > 0) ? $products_log->width_mm : "" ?>">
                                </div>
                             <?php } ?>
                             <?php  if($products_log->width > 0){ ?>
                                <div class="form-group col-md-2">
                                    <label for="productmaterial" class="control-label">Width (IN MM) *</label>
                                    <input type="text" id="width" name="width" readonly="" class="form-control" value="<?php echo (isset($products_log->width) && $products_log->width > 0) ? $products_log->width : "" ?>">
                                </div>
                             <?php } ?>
                             
                             <?php  if($products_log->diameter > 0){ ?>
                            <div class="form-group col-md-2">
                                <label for="productmaterial" class="control-label">Diameter (In MM) *</label>
                                <input type="text" id="diameter" name="diameter" readonly="" class="form-control" value="<?php echo (isset($products_log->diameter) && $products_log->diameter > 0) ? $products_log->diameter : "" ?>">
                            </div>
                             <?php } ?>
                             <?php  if($products_log->edge_width_small > 0){ ?>
                            <div class="form-group col-md-2">
                                <label for="productmaterial" class="control-label">Edge Width Small (In MM) *</label>
                                <input type="text" id="edge_width_small" name="edge_width_small" readonly="" class="form-control" value="<?php echo (isset($products_log->edge_width_small) && $products_log->edge_width_small > 0) ? $products_log->edge_width_small : "" ?>">
                            </div>
                             <?php } ?>
                             <?php  if($products_log->edge_width > 0){ ?>
                            <div class="form-group col-md-2">
                                <label for="productmaterial" class="control-label">Edge Width (In MM) *</label>
                                <input type="text" id="edge_width" name="edge_width" readonly="" class="form-control" value="<?php echo (isset($products_log->edge_width) && $products_log->edge_width > 0) ? $products_log->edge_width : "" ?>">
                            </div>
                             <?php } ?>
                             <?php  if($products_log->edge_length > 0){ ?>
                            <div class="form-group col-md-2">
                                <label for="productmaterial" class="control-label">Edge Length (In MM) *</label>
                                <input type="text" id="edge_length" name="edge_length" readonly="" class="form-control" value="<?php echo (isset($products_log->edge_length) && $products_log->edge_length > 0) ? $products_log->edge_length : "" ?>">
                            </div>
                             <?php } ?>
                        <?php
                      if(!empty($products_log->photo) && $products_log->photo != '--'){
                        ?>
                        <div class="col-md-12"><h3>Product Main Image</h3><hr/></div>
                        <img src="<?php echo base_url('uploads/product') . "/" . $products_log->photo; ?>" class="image-responsive" style="height: 100px; width : 100px;" alt="" />
                        <?php
                        }
                        if(!empty($multiple_images)){
                            echo '<div class="col-md-12"><h3>Product Sub Images</h3><hr/></div><div class="table-responsive s_table">';
                            foreach ($multiple_images as  $r1) {
                                if(!empty($r1->file_name) && $r1->file_name != '--'){
                                ?>
                                <img src="<?php echo base_url('uploads/product/product_multiple') . "/" . $r1->file_name; ?>" class="image-responsive" style="height: 100px; width : 100px;" alt="" />
                                <?php
                                }
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
                                            <th width="20%" align="left">Size (In MM)</th>
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
                                                    <td><?php echo $value->size; ?></td>
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

                                <div class="col-md-12"><h3>Add Product Drawings</h3><hr/></div>
                                <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="5%"  align="center">S.No.</th>
                                            <th width="40%" align="left">Name of Drawing</th>
                                            <th width="20%" align="left">Drawing ID</th>
                                            <th width="10%" align="left">Rev No</th>
                                            <th width="20%" align="left">Drawing</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (!empty($productdrawing_list)) {
                                            $i = 0;
                                            foreach ($productdrawing_list  as $key => $value) {

                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo cc($value->drawing_name) ?></td>
                                                    <td><?php echo $value->drawing_id; ?></td>
                                                    <td><?php echo $value->rev_no; ?></td>
                                                    <td>
                                                      <?php if (!empty($value->files)){
                                                          $filesdata = json_decode($value->files);
                                                          foreach ($filesdata as $k => $file) {
                                                      ?>
                                                            <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                      <?php
                                                          }
                                                      } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else{
                                           ?>
                                           <tr>
                                                <td colspan="4">product drawing Not Available</td>
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
                                        <textarea disabled="" class="form-control"><?php echo $products_log->faq; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Merging Remark</label>
                                        <textarea disabled="" class="form-control"><?php echo $products_log->merging_remark; ?></textarea>
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
