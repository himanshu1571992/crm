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
                                <h3><?php
                                    if (isset($product['id']))
                                        echo _l('edit_product');
                                    else
                                        echo _l('add_product');
                                    ?>
                                        </h3>
                                    
                                <hr/>

                            </div>
                                
				<div class="form-group col-md-6">
                                    <label for="product_cat_id" class="control-label">Product Main Category</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product['product_cat_id']) && $product['product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="product_sub_cat_id" class="control-label">Product Root Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="product_sub_cat_id" name="product_sub_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_sub_cat_data) && count($pro_sub_cat_data) > 0) {
                                            foreach ($pro_sub_cat_data as $pro_sub_cat_key => $pro_sub_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_sub_cat_value['id'] ?>" <?php echo (isset($product['product_sub_cat_id']) && $product['product_sub_cat_id'] == $pro_sub_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_sub_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="parent_category_id" class="control-label">Product Parent Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="parent_category_id" name="parent_category_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($parent_category_info) && count($parent_category_info) > 0) {
                                            foreach ($parent_category_info as $parent_cat_key => $parent_cat_value) {
                                                ?>
                                                <option value="<?php echo $parent_cat_value['id'] ?>" <?php echo (isset($product['parent_category_id']) && $product['parent_category_id'] == $parent_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($parent_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                 <div class="form-group col-md-6">
                                    <label for="child_category_id" class="control-label">Product Child Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="child_category_id" name="child_category_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($child_category_info) && count($child_category_info) > 0) {
                                            foreach ($child_category_info as $child_cat_key => $child_cat_value) {
                                                ?>
                                                <option value="<?php echo $child_cat_value['id'] ?>" <?php echo (isset($product['child_category_id']) && $product['child_category_id'] == $child_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($child_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="productname" class="control-label"><?php echo _l('product_name'); ?>*</label>
                                    <input type="text" id="productname" name="name" required="" class="form-control" value="<?php echo (isset($product['name']) && $product['name'] != "") ? $product['name'] : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="productsubname" class="control-label"><?php echo 'Print Name'; ?></label>  &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" id="as_product" name=""> <small style="color: red;">As Product name</small>
                                    <input type="text" id="productsubname" name="sub_name" class="form-control" value="<?php echo (isset($product['sub_name']) && $product['sub_name'] != "") ? $product['sub_name'] : "" ?>">
                                </div>


                                <div class="col-md-12"><h3>Custom Product Fields</h3><hr/></div>
                                <div id="custom_field_div">
                                    <?php
                                     if(!empty($field_info) && !empty($product)){
                                        $html = '';
                                        foreach ($field_info as $row) {
                                            $required = "";
                                            $require_html = "";
                                            if($row->required == 1){
                                                $required = "required";
                                                $require_html = "<span style=\"color: red;\">*</span>";
                                            }
                                            $custom_value = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`='".$product['id']."' and field_id = '".$row->field_id."' ")->row();
                                            $field_value = '';
                                            if(!empty($custom_value)){
                                                $field_value = $custom_value->field_value;
                                            }
                                            if($row->type == 1){                            
                                                $html .= '<div class="form-group col-md-'.$row->size.'">
                                                        <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.' </label>
                                                        <input type="text" id="'.$row->field_id.'" value="'.$field_value.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control" value="">
                                                    </div>';
                                            }if($row->type == 2){
                                                $html .= '<div class="form-group col-md-'.$row->size.'" >
                                                        <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                                        <textarea id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control">'.$field_value.'</textarea>
                                                    </div>';
                                            }if($row->type == 3){
                                                $html .= '<div class="form-group col-md-'.$row->size.'">
                                                        <label for="drawing" class="control-label">'.$row->name.$require_html.'</label>
                                                        <input type="file" id="drawing" name="drawing[]" multiple="" '.$required.'><br>';
                                                if(!empty($product_drawing)){
                                                    foreach ($product_drawing as $kt => $r2) {
                                                        $html .= '<a href="'.base_url('uploads/product/product_drawing') . '/' . $r2->file_name.'" download>'.$r2->file_name.'</a><br>';
                                                    }
                                                }
                                                $html .= '</div>';
                                            }
                                        }
                                        echo $html;
                                    }
                                    ?>
                                </div>
                                



                                <div class="col-md-12"><h3>Othe Product Information</h3><hr/></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-2">
                                            <label for="unit_id" class="control-label"><?php echo _l('product_unit'); ?></label>
                                            <select class="form-control selectpicker" data-live-search="true" id="unit_id" name="unit_id" required="">
                                                <option value=""></option>
                                                <?php
                                                if (isset($unit_data) && count($unit_data) > 0) {
                                                    foreach ($unit_data as $unit_key => $unit_value) {
                                                        ?>
                                                        <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($product['unit_id']) && $product['unit_id'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="productname" class="control-label">Size</label>
                                            <input type="text" id="productname" name="size" class="form-control" value="<?php echo (isset($product['size']) && $product['size'] != "") ? $product['size'] : "" ?>">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="unit_1" class="control-label">Unit 1</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="unit_1" name="unit_1">
                                                <option value=""></option>
                                                <?php
                                                if (isset($unit_data) && count($unit_data) > 0) {
                                                    foreach ($unit_data as $unit_key => $unit_value) {
                                                        ?>
                                                        <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($product['unit_1']) && $product['unit_1'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="productname" class="control-label">Conversion 1</label>
                                            <input type="text" id="productname" name="conversion_1" class="form-control" value="<?php echo (isset($product['conversion_1']) && $product['conversion_1'] != "") ? $product['conversion_1'] : "" ?>">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="unit_2" class="control-label">Unit 2 <small>(For PDF View)</small></label>
                                            <select class="form-control selectpicker" data-live-search="true" id="unit_2" name="unit_2" required="">
                                                <option value=""></option>
                                                <?php
                                                if (isset($unit_data) && count($unit_data) > 0) {
                                                    foreach ($unit_data as $unit_key => $unit_value) {
                                                        ?>
                                                        <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($product['unit_2']) && $product['unit_2'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="productname" class="control-label">Conversion 1</label>
                                            <input type="text" id="productname" name="conversion_2" class="form-control" value="<?php echo (isset($product['conversion_2']) && $product['conversion_2'] != "") ? $product['conversion_2'] : "" ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-2">
                                            <label for="min_qty" class="control-label">Min Quantity</label>
                                            <input type="text" id="min_qty" name="min_qty" class="form-control" value="<?php echo (isset($product['min_qty']) && $product['min_qty'] != "") ? $product['min_qty'] : "" ?>">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="max_qty" class="control-label">Max Quantity</label>
                                            <input type="text" id="max_qty" name="max_qty" class="form-control" value="<?php echo (isset($product['max_qty']) && $product['max_qty'] != "") ? $product['max_qty'] : "" ?>">
                                        </div> 
                                        <div class="form-group col-md-2">
                                            <label for="productname" class="control-label">Sales Price *</label>
                                            <input type="text" id="productname" name="price" class="form-control" value="<?php echo (isset($product['price']) && $product['price'] != "") ? $product['price'] : "" ?>">
                                        </div>


                                        <!-- <div class="form-group col-md-2">
                                            <label for="productname" class="control-label">Min Qty</label>
                                            <input type="number" id="productname" name="min_qty" class="form-control" value="<?php echo (isset($product['min_qty']) && $product['min_qty'] != "") ? $product['min_qty'] : "" ?>">
                                        </div>
        
                                        <div class="form-group col-md-2">
                                            <label for="max_qty" class="control-label">Max Qty</label>
                                            <input type="number" id="max_qty" name="max_qty" class="form-control" value="<?php echo (isset($product['max_qty']) && $product['max_qty'] != "") ? $product['max_qty'] : "" ?>">
                                        </div> -->

                                        <div class="form-group col-md-2">
                                            <label for="gst_id" class="control-label">GST Percent</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="gst_id" name="gst_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($tax_data) && count($tax_data) > 0) {
                                                    foreach ($tax_data as $tax_key => $tax_value) {
                                                        ?>
                                                        <option value="<?php echo $tax_value['id'] ?>" <?php echo (isset($product['gst_id']) && $product['gst_id'] == $tax_value['id']) ? 'selected' : "" ?>><?php echo $tax_value['name'] . ' (' . $tax_value['taxrate'] . ') '; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="master_id" class="control-label">Product Master</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="master_id" name="master_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($product_master) && count($product_master) > 0) {
                                                    foreach ($product_master as $value) {
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo (isset($product['master_id']) && $product['master_id'] == $value['id']) ? 'selected' : "" ?>><?php echo $value['name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>



                                        <!--  <div class="form-group col-md-3">
                                             <label for="isOtherCharge" class="control-label">Is Other Charges</label>
                                             <select class="form-control selectpicker" data-live-search="true" id="isOtherCharge" name="isOtherCharge">
                                                 <option value="0" <?php echo (isset($product['isOtherCharge']) && $product['isOtherCharge'] == 0) ? 'selected' : "" ?>>No</option>
                                                 <option value="1" <?php echo (isset($product['isOtherCharge']) && $product['isOtherCharge'] == 1) ? 'selected' : "" ?>>Yes</option>
                                                
                                             </select>
                                         </div> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-4">
                                            <label for="status" class="control-label"><?php echo _l('product_status'); ?> *</label>
                                            <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                                <option value=""></option>
                                                <option value="1" <?php echo (isset($product['status']) && $product['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                                <option value="0" <?php echo (isset($product['status']) && $product['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                            </select>
                                        </div>

                                        <?php
                                        // image
                                        $url = base_url('assets/images/no_image_available.jpeg');
                                        if (!empty($product) && $product['photo'] != "") {
                                            $url = base_url('uploads/product') . "/" . $product['photo'];
                                        }

                                        ?>
                                        <div class="form-group col-md-4">
                                            <label for="photo" class="control-label">Product Main Image</label>
                                            <input type="file" id="photo" name="photo">
                                            <?php
                                            echo '<a target="_blank" href="' . $url . '"><img src="' . $url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="" /></a>';
                                            ?>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="photo_multiple" class="control-label">Product Multiple Images</label>
                                            <input type="file" id="photo_multiple" name="photo_multiple[]" multiple="">
                                            <?php
                                            if (!empty($multiple_images)) {
                                                foreach ($multiple_images as $multi) {
                                                    $multi_url = base_url('uploads/product/product_multiple') . "/" . $multi->file_name;
                                                    if (!empty($multi->file_name)) {
                                                        echo '<a target="_blank" href="' . $multi_url . '"><img src="' . $multi_url . '" class="image-responsive" style="height: 100px; width : 100px;"></a>&nbsp;';
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            
                                            ?>
                                        </div>

                                        <!-- <div class="form-group col-md-4">
                                            <label for="drawing" class="control-label">Product Drawing</label>
                                            <input type="file" id="drawing" name="drawing[]" multiple="">
                                        </div> -->
<?php
/* if (isset($product['photo']) && $product['photo'] != "") {
  ?>
  <div class="form-group proimg">
  <label class="control-label"></label>
  <img src="<?php echo base_url('uploads/product') . "/" . $product['id'] . "/" . $product['photo'] ?>" style="width: 150px; height: 150px;">
  <a class="removeimg" value="<?php echo $product['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>
  </div>
  <?php
  } */
?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-4">
                                            <label for="status" class="control-label">Product Material</label>
                                            <select class="form-control selectpicker productmaterial_id" data-live-search="true" name="productmaterial_id">
                                                <option value=""></option>
                                                <?php
                                                    if (!empty($productmaterial_list)){
                                                        foreach ($productmaterial_list as $vlist) {
                                                            $selected = (isset($product['productmaterial_id']) && $product['productmaterial_id'] == $vlist->id) ? 'selected' : "";
                                                            echo '<option value="'.$vlist->id.'" '.$selected.'>'.cc($vlist->name).'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="product_material_fields">
                                            <?php if (!empty($product['width']) && $product['width'] > 0 && $product['productmaterial_id'] > 0){ ?>
                                                <div class="form-group col-md-2">
                                                    <label for="productmaterial" class="control-label">Width (In MM)*</label>
                                                    <input type="text" id="width" name="width" class="form-control" value="<?php echo (isset($product['width']) && $product['width'] != "") ? $product['width'] : "" ?>">
                                                </div>
                                            <?php  }?>
                                            <?php if (!empty($product['diameter']) && $product['diameter'] > 0 && $product['productmaterial_id'] > 0){ ?>
                                                <div class="form-group col-md-2">
                                                    <label for="productmaterial" class="control-label">Diameter (In MM)*</label>
                                                    <input type="text" id="diameter" name="diameter" class="form-control" value="<?php echo (isset($product['diameter']) && $product['diameter'] != "") ? $product['diameter'] : "" ?>">
                                                </div>
                                            <?php  }?>
                                            <?php if (!empty($product['edge_width_small']) && $product['edge_width_small'] > 0 && $product['productmaterial_id'] > 0){ ?>
                                                <div class="form-group col-md-2">
                                                    <label for="productmaterial" class="control-label"> Edge Width Small (In MM)*</label>
                                                    <input type="text" id="edge_width_small" name="edge_width_small" class="form-control" value="<?php echo (isset($product['edge_width_small']) && $product['edge_width_small'] != "") ? $product['edge_width_small'] : "" ?>">
                                                </div>
                                            <?php  }?>
                                            <?php if (!empty($product['edge_width']) && $product['edge_width'] > 0 && $product['productmaterial_id'] > 0){ ?>
                                                <div class="form-group col-md-2">
                                                    <label for="productmaterial" class="control-label">Edge Width (In MM)*</label>
                                                    <input type="text" id="edge_width" name="edge_width" class="form-control" value="<?php echo (isset($product['edge_width']) && $product['edge_width'] != "") ? $product['edge_width'] : "" ?>">
                                                </div>
                                            <?php  }?>
                                            <?php if (!empty($product['edge_length']) && $product['edge_length'] > 0 && $product['productmaterial_id'] > 0){ ?>
                                                <div class="form-group col-md-2">
                                                    <label for="productmaterial" class="control-label">Edge Length (In MM)*</label>
                                                    <input type="text" id="edge_length" name="edge_length" class="form-control" value="<?php echo (isset($product['edge_length']) && $product['edge_length'] != "") ? $product['edge_length'] : "" ?>">
                                                </div>
                                            <?php  }?>
                                            
                                        </div>
                                        
                    
                                    </div>
                                </div>

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo 'Edit Items';
                                    else
                                        echo 'Add Items';
                                    ?></h3>
                                <hr/>
                            </div>

                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="50%" align="left">Item Name</th>
                                            <th width="20%" align="left">Size (In MM)</th>
                                            <th width="5%" align="left">View</th>
                                            <th width="20%" class="qty" align="left">Qty</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (!empty($productcomponent)) {
                                            $i = 0;
                                            foreach ($productcomponent as $singleproductcomp) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" onchange="get_comp_det(<?php echo $i; ?>,this.value)" id="componnet_id" name="componnetdata[<?php echo $i; ?>][componnetid]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $unit_key => $item_value) {
                                                                        ?>
                                                                        <option value="<?php echo $item_value['id'] ?>" <?php echo (isset($item_value['id']) && $singleproductcomp['item_id'] == $item_value['id']) ? 'selected' : "" ?>><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="size" name="componnetdata[<?php echo $i; ?>][size]" class="form-control" value="<?php echo (isset($singleproductcomp['size']) && $singleproductcomp['size'] != "") ? $singleproductcomp['size'] : ""; ?>" >
                                                        </div>
                                                    </td>
                                                    <td id="view<?php echo $i; ?>"><a href="../../product_new/view/<?php echo $singleproductcomp['item_id'];?>" target="_blank">view</a></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="compqty" name="componnetdata[<?php echo $i; ?>][compqty]" class="form-control" value="<?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger " onclick="removeprocomp('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="main" id="tr0">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="componnet_id" onchange="get_comp_det(0,this.value)" name="componnetdata[0][componnetid]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $unit_key => $item_value) {
                                                                    ?>
                                                                    <option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" id="size" name="componnetdata[0][size]" class="form-control" >
                                                    </div>
                                                </td>
						<td id="view0"></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" id="compqty" name="componnetdata[0][compqty]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($productcomponent)){ echo count($productcomponent); }else{ echo '0'; }  ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>


                            </div>
                            <div class="form-group col-md-12" style="margin-top: 50px;">
                                    <label for="name" class="control-label">FAQ </label>
                                    <textarea id="faq" name="faq" class="form-control tinymce"><?php echo (isset($product['faq']) && $product['faq'] != "") ? $product['faq'] : "" ?></textarea>
                                </div>

                            <div class="form-group col-md-12" style="margin-top: 50px;">
                                    <label for="merging_remark" class="control-label">Merging Remark </label>
                                    <textarea id="merging_remark" name="merging_remark" class="form-control tinymce"><?php echo (isset($product['merging_remark']) && $product['merging_remark'] != "") ? $product['merging_remark'] : "" ?></textarea>
                                </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
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

<script>
    init_selectpicker();
</script>
<script>
    $('.removeimg').click(function () {
        if (confirm("Are you sure?"))
        {
            var proid = $(this).attr('value');
            var url = admin_url + 'Product/imagedelete/';
            $.post(url,
                    {
                        proid: proid,
                    },
                    function (data, status) {
                        //$('.proimg').load(url + ' .proimg'); 
                        $('.proimg').hide();
                    });
        }
    });
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="get_comp_det(' + newaddmore + ',this.value)" name="componnetdata[' + newaddmore + '][componnetid]" data-live-search="true"><option value=""></option><?php
if (isset($item_data) && count($item_data) > 0) {
    foreach ($item_data as $unit_key => $item_value) {
        ?><option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option><?php
    }
}
?></select></div></td><td> <div class="form-group"><input type="number" id="size" name="componnetdata[' + newaddmore + '][size]" class="form-control" ></div></td><td id="view'+newaddmore+'"></td><td> <div class="form-group"><input type="number" id="compqty" name="componnetdata[' + newaddmore + '][compqty]" class="form-control" ></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	init_selectpicker();

    function get_subcategory_by_category(cat_id) {
        var html = '<option value=""></option>';
        
        if(cat_id == "") {
            $("#product_sub_cat_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_subcat_by_cat_id/' + cat_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#product_sub_cat_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	function get_comp_det(proid,value)
	{
		var component_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_comp_det/'+component_id,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#view'+proid).html('<a href="../view/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
</script>


<script> 
    $(document).ready(function() { 
    
        $("#as_product").click(function() { 
            if($('#as_product').is(':checked')){
               var product_name = $("#productname").val();
                $("#productsubname").val(product_name);
            }else{
                $("#productsubname").val(' ');
            }
        }); 
    }); 
</script> 

<script type="text/javascript">
$(document).on('change', '#product_sub_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_parent_categoty",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#parent_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/check_bundles_entry",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#child_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>



<!-- For Getting Custom Fields Category Wise -->
<script type="text/javascript">
$(document).on('change', '#product_cat_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $("#product_sub_cat_id").html('');
    $("#parent_category_id").html('');
    $("#child_category_id").html('');
    $('.selectpicker').selectpicker('refresh');
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 1, 'p_id' : p_id},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#product_sub_cat_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 2, 'p_id' : p_id},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 3, 'p_id' : p_id},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#child_category_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 4, 'p_id' : p_id},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 
$(document).on('change', '.productmaterial_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $(".productmaterial_width").hide();
    $(".productmaterial_diameter").hide();
    $(".productmaterial_thickness").hide();
    if (id !=""){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/product_new/get_productmaterial_field",
            data    : {'id' : id, 'p_id': p_id},
            success : function(response){
                $(".product_material_fields").html(response);
            }
        });
    }
    
}); 
</script>
</body>
</html>
