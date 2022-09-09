<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php
                $url = (isset($tempproduct_info) && !empty($tempproduct_info)) ? admin_url("product_new/product") : $this->uri->uri_string();
                echo form_open($url, array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data'));
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                        echo "Convert To Product";
                                    }else{
                                        echo (isset($product['id'])) ? _l('edit_product') : _l('add_product');
                                    }

                                    ?>
                                        <div class="pull-right" style="margin-top:-6px;"><label class="control-label">Is Verified</label>   <input type="checkbox" value="1" name="is_varified" <?php echo (isset($product['is_varified']) && $product['is_varified'] == 1) ? 'checked' : "" ?>></div>
                                    </h3>

                                <hr/>
                            </div>
                                <input type="hidden" id="edit_product_id" value="<?php echo $edit_product_id; ?>" >
                                <input type="hidden" id="temp_product_id" name="temperoryproduct_id" value="<?php echo (isset($tempproduct_info) && !empty($tempproduct_info)) ? $tempproduct_info["id"] : 0; ?>" >

                                <div class="form-group col-md-6">
                                    <label for="division_id" class="control-label">Division<span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" required="" onchange="getsubdivision(this.value);" id="division_id" name="division_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($division_list) && count($division_list) > 0) {
                                            foreach ($division_list as $division_key => $division) {
                                                ?>
                                                <option value="<?php echo $division['id'] ?>" <?php echo (isset($product['division_id']) && $product['division_id'] == $division['id']) ? 'selected' : "" ?>><?php echo cc($division['title']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                 <div class="form-group col-md-6">
                                    <label for="sub_division_id" class="control-label">Sub Division</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="sub_division_id" name="sub_division_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($sub_division_list) && count($sub_division_list) > 0) {
                                            foreach ($sub_division_list as $sub_division_key => $sub_division) {
                                                ?>
                                                <option value="<?php echo $sub_division['id'] ?>" <?php echo (isset($product['sub_division_id']) && $product['sub_division_id'] == $sub_division['id']) ? 'selected' : "" ?>><?php echo cc($sub_division['title']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="product_cat_id" class="control-label">Product Main Category<span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" required="" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                                    $selectedcls = (isset($tempproduct_info["category_id"]) && $tempproduct_info["category_id"] == $pro_cat_value['id']) ? 'selected' : "";
                                                }else{
                                                    $selectedcls = (isset($product['product_cat_id']) && $product['product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "";
                                                }
                                        ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo $selectedcls; ?>><?php echo cc($pro_cat_value['name']); ?></option>
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
                                    <select class="form-control selectpicker" data-live-search="true"  id="child_category_id" name="child_category_id">
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
                                    <label for="productname" class="control-label"><?php echo _l('product_name'); ?><span style="color: red;">*</span></label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $productname = (isset($tempproduct_info['product_name']) && $tempproduct_info['product_name'] != "") ? $tempproduct_info['product_name'] : "";
                                        }else{
                                            $productname = (isset($product['name']) && $product['name'] != "") ? $product['name'] : "";
                                        }
                                    ?>
                                    <input type="text" id="productname" name="name" required="" class="form-control" value="<?php echo $productname; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $checked_data = "checked";
                                            $sub_name = (isset($tempproduct_info['product_name']) && $tempproduct_info['product_name'] != "") ? $tempproduct_info['product_name'] : "";
                                        }else{
                                            $checked_data = "";
                                            $sub_name = (isset($product['sub_name']) && $product['sub_name'] != "") ? $product['sub_name'] : "";
                                        }
                                    ?>
                                    <label for="productsubname" class="control-label"><?php echo 'Print Name'; ?><span style="color: red;">*</span></label>  &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" id="as_product" <?php echo $checked_data; ?> name=""> <small style="color: red;">As Product name</small>
                                    <input type="text" id="productsubname" name="sub_name" required="" class="form-control" value="<?php echo $sub_name; ?>">
                                </div>
                                <div class="col-md-12"><h3>Printing Name Details</h3><hr/></div>
                                <div class="form-group col-md-3">
                                    <label for="print_thickness" class="control-label">Thickness</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_thickness = (isset($tempproduct_info['print_thickness']) && $tempproduct_info['print_thickness'] != "") ? $tempproduct_info['print_thickness'] : "";
                                        }else{
                                            $print_thickness = (isset($product['print_thickness']) && $product['print_thickness'] != "") ? $product['print_thickness'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_thickness" name="print_thickness" class="form-control" value="<?php echo $print_thickness; ?>">
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="print_diameter" class="control-label">Diameter</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_diameter = (isset($tempproduct_info['print_diameter']) && $tempproduct_info['print_diameter'] != "") ? $tempproduct_info['print_diameter'] : "";
                                        }else{
                                            $print_diameter = (isset($product['print_diameter']) && $product['print_diameter'] != "") ? $product['print_diameter'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_diameter" name="print_diameter" class="form-control" value="<?php echo $print_diameter; ?>">
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="print_width" class="control-label">Width</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_width = (isset($tempproduct_info['print_width']) && $tempproduct_info['print_width'] != "") ? $tempproduct_info['print_width'] : "";
                                        }else{
                                            $print_width = (isset($product['print_width']) && $product['print_width'] != "") ? $product['print_width'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_width" name="print_width" class="form-control" value="<?php echo $print_width; ?>">
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="print_height" class="control-label">Height</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_height = (isset($tempproduct_info['print_height']) && $tempproduct_info['print_height'] != "") ? $tempproduct_info['print_height'] : "";
                                        }else{
                                            $print_height = (isset($product['print_height']) && $product['print_height'] != "") ? $product['print_height'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_height" name="print_height" class="form-control" value="<?php echo $print_height; ?>">
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="print_length" class="control-label">Length</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_length = (isset($tempproduct_info['print_length']) && $tempproduct_info['print_length'] != "") ? $tempproduct_info['print_length'] : "";
                                        }else{
                                            $print_length = (isset($product['print_length']) && $product['print_length'] != "") ? $product['print_length'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_length" name="print_length" class="form-control" value="<?php echo $print_length; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="print_range" class="control-label">Range</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_range = (isset($tempproduct_info['print_range']) && $tempproduct_info['print_range'] != "") ? $tempproduct_info['capacity'] : "";
                                        }else{
                                            $print_range = (isset($product['print_range']) && $product['print_range'] != "") ? $product['print_range'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_range" name="print_range" class="form-control" value='<?php echo $print_range; ?>'>
                                </div> 
                                <div class="form-group col-md-3">
                                    <label for="print_capacity" class="control-label">Capacity</label>
                                    <?php
                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                            $print_capacity = (isset($tempproduct_info['print_capacity']) && $tempproduct_info['print_capacity'] != "") ? $tempproduct_info['print_capacity'] : "";
                                        }else{
                                            $print_capacity = (isset($product['print_capacity']) && $product['print_capacity'] != "") ? $product['print_capacity'] : "";
                                        }
                                    ?>
                                    <input type="text" id="print_capacity" name="print_capacity" class="form-control" value="<?php echo $print_capacity; ?>">
                                </div> 
                                <div class="form-group col-md-3">
                                    <label for="print_capacity" class="control-label">.</label>
                                    <a href="javascript:void(0);" id="generate_system_name" name="generate_system_name" class="form-control btn btn-success">Generate System Name</a>
                                </div>   
                                <hr>      
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
                                            $custom_value = $this->db->query("SELECT * FROM `tblproductsfield` where `product_id`='".$product['id']."' and field_id = '".$row->field_id."' ")->row();
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

                                                $file_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='".$product['id']."' and rel_type = 'drawing' ")->result();

                                                if(!empty($file_info)){
                                                    $required = '';
                                                }

                                                $html .= '<div class="form-group col-md-'.$row->size.'">
                                                        <label for="drawing" class="control-label">'.$row->name.$require_html.'</label>
                                                        <input type="file" id="drawing" name="drawing[]" multiple="" '.$required.'>';
                                                        if(!empty($file_info)){
                                                            foreach ($file_info as $file) {
                                                                $html .= '<a target="_blank" href="'.site_url('uploads/product/product_drawing/'.$file->file_name).'">'.$file->file_name.'</a><br>';
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
                                                        if (isset($tempproduct_info) && !empty($tempproduct_info)){
                                                            $selectedcls = (isset($tempproduct_info['unit']) && $tempproduct_info['unit'] == $unit_value['id']) ? 'selected' : "";
                                                        }else{
                                                            $selectedcls = (isset($product['unit_id']) && $product['unit_id'] == $unit_value['id']) ? 'selected' : "";
                                                        }
                                                ?>
                                                        <option value="<?php echo $unit_value['id'] ?>" <?php echo $selectedcls; ?>><?php echo $unit_value['name'] ?></option>
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
                                            <?php
                                            if (isset($tempproduct_info) && !empty($tempproduct_info)) {
                                                $price = (isset($tempproduct_info['price']) && $tempproduct_info['price'] != "") ? $tempproduct_info['price'] : "";
                                            } else {
                                                $price = (isset($product['price']) && $product['price'] != "") ? $product['price'] : "";
                                            }
                                            ?>
                                            <input type="text" id="productname" name="price" class="form-control" value="<?php echo $price; ?>">
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
                                        <div class="form-group col-md-2">
                                            <label for="status" class="control-label">Width (MM) *</label>
                                            <input type="number" step="any" id="width_mm" name="width_mm" class="form-control" value="<?php echo (isset($product['width_mm']) && $product['width_mm'] != "") ? $product['width_mm'] : "" ?>">
                                        </div>
                                        <div class="form-group col-md-2">
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

                                        if(!empty($product)){
                                            $mutlimages_info = $this->db->query("SELECT * FROM `tblproductfiles` where `rel_id`='" . $product['id'] . "' and rel_type = 'mutliple_image' ")->result();
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
                                            if (!empty($mutlimages_info)) {
                                                foreach ($mutlimages_info as $multi) {
                                                    $multi_url = base_url('uploads/product/product_multiple') . "/" . $multi->file_name;
                                                    if (!empty($multi->file_name)) {
                                                        echo '<a target="_blank" href="' . $multi_url . '"><img src="' . $multi_url . '" class="image-responsive" style="height: 100px; width : 100px;"></a><br>';
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
                                                                        <option value="<?php echo $item_value['id'] ?>" <?php echo (isset($item_value['id']) && $singleproductcomp['item_id'] == $item_value['id']) ? 'selected' : "" ?>><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).') (PRO-'.$item_value['id'].')'; ?></option>
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
                                                                    <option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).') (PRO-'.$item_value['id'].')'; ?></option>
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

                            <div class="col-md-12">
                                <h3><?php echo (isset($product['id'])) ? 'Edit Product Drawing':'Add Product Drawing'; ?></h3>
                                <hr/>
                            </div>
                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTabledrawing">
                                    <thead>
                                        <tr>
                                            <th width="40%" align="left">Name of Drawing</th>
                                            <th width="20%" align="left">Drawing ID</th>
                                            <th width="10%" align="left">Rev No</th>
                                            <th width="20%" align="left">Drawing</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php

                                        if (!empty($product_drawingdata)) {
                                            $i = 0;
                                            foreach ($product_drawingdata as $productdrawing) {
                                                $i++;

                                                ?>
                                                <tr class="prodrawing" id="ptr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="drawing_name<?php echo $i; ?>" name="productdrawing[<?php echo $i; ?>][drawing_name]" class="form-control" value="<?php echo (isset($productdrawing['drawing_name']) && $productdrawing['drawing_name'] != "") ? $productdrawing['drawing_name'] : ""; ?>" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="drawing_id<?php echo $i; ?>" name="productdrawing[<?php echo $i; ?>][drawing_id]" class="form-control" value="<?php echo (isset($productdrawing['drawing_id']) && $productdrawing['drawing_id'] != "") ? $productdrawing['drawing_id'] : ""; ?>" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="rev_no<?php echo $i; ?>" name="productdrawing[<?php echo $i; ?>][rev_no]" class="form-control" value="<?php echo (isset($productdrawing['rev_no']) && $productdrawing['rev_no'] != "") ? $productdrawing['rev_no'] : ""; ?>" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                          <?php if (!empty($productdrawing['files'])){
                                                              $filesdata = json_decode($productdrawing['files']);
                                                              foreach ($filesdata as $k => $file) {
                                                          ?>
                                                                <a href="<?php echo base_url('uploads/product/product_drawing') . "/" . $file; ?>" target="_blank"><?php echo $file; ?></a><br>
                                                          <?php
                                                              }
                                                          } ?>
                                                          <input type="hidden" name="productdrawing[<?php echo $i; ?>][files]" value='<?php echo (isset($productdrawing['files']) && !empty($productdrawing['files'])) ? $productdrawing['files'] : ""; ?>'>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger " onclick="removeprodrawing('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="prodrawing" id="ptr0">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="drawing_name0" name="productdrawing[0][drawing_name]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="drawing_id0" name="productdrawing[0][drawing_id]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="rev_no0" name="productdrawing[0][rev_no]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="file" id="drawingfile0" name="productdrawing0[]" multiple="" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger " onclick="removeprodrawing(0);"><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmoreprodrawing" value="<?php if(!empty($product_drawingdata)){ echo count($product_drawingdata); }else{ echo '0'; }  ?>">Add More <i class="fa fa-plus"></i></a></label>
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
        ?><option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).') (PRO-'.$item_value['id'].')'; ?></option><?php
    }
}
?></select></div></td><td> <div class="form-group"><input type="number" id="size" name="componnetdata[' + newaddmore + '][size]" class="form-control" ></div></td><td id="view'+newaddmore+'"></td><td> <div class="form-group"><input type="number" id="compqty" name="componnetdata[' + newaddmore + '][compqty]" class="form-control" ></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
    $('.addmoreprodrawing').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTabledrawing tbody').append('<tr class="prodrawing" id="ptr' + newaddmore + '"><td><div class="form-group"><input type="text" id="drawing_name' + newaddmore + '" name="productdrawing[' + newaddmore + '][drawing_name]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="drawing_id' + newaddmore + '" name="productdrawing[' + newaddmore + '][drawing_id]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="rev_no' + newaddmore + '" name="productdrawing[' + newaddmore + '][rev_no]" class="form-control" ></div></td><td><div class="form-group"><input type="file" id="drawingfile' + newaddmore + '" name="productdrawing' + newaddmore + '[]" multiple="" class="form-control" ></div></td><td><button type="button" class="btn pull-right btn-danger " onclick="removeprodrawing('+ newaddmore +');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
    function removeprodrawing(procompid)
    {
        $('#ptr' + procompid).remove();
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
  function getsubdivision(division_id) {
    $.ajax({
            url : admin_url+'product_new/get_sub_division/'+division_id,
            method : 'GET',
            success:function(res) {
              $('#sub_division_id').html(res);
              $('.selectpicker').selectpicker('refresh');
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
$(document).on("click", "#generate_system_name", function(){
    var productname = $("#productname").val();
    var print_thickness = $("#print_thickness").val();
    var print_diameter = $("#print_diameter").val();
    var print_width = $("#print_width").val();
    var print_height = $("#print_height").val();
    var print_length = $("#print_length").val();
    var print_range = $("#print_range").val();
    var print_capacity = $("#print_capacity").val();
    if (productname != ''){
        var field_count = 0;
        var field_space = '';
        if (print_thickness != ""){
            productname = productname+' '+print_thickness+'(T)';
            field_count++;
        }
        if (print_diameter != ""){
            field_space = (field_count > 0) ?  ' X ' : ' ';
            productname = productname+field_space+print_diameter+'(Ø)';
            
            field_count++;
        }
        if (print_width != ""){
            field_space = (field_count > 0) ?  ' X ' : ' ';
            productname = productname+field_space+print_width+'(W)';
            field_count++;
        }
        if (print_height != ""){
            field_space = (field_count > 0) ?  ' X ' : ' ';
            productname = productname+field_space+print_height+'(H)';
            field_count++;
        }
        if (print_length != ""){
            field_space = (field_count > 0) ?  ' X ' : ' ';
            productname = productname+field_space+print_length+'(L)';
        }
        if (print_capacity != ""){
            productname = productname+' (Capacity - '+print_capacity+') ';
        }
        if (print_range != ""){
            productname = productname+' (Range - '+print_range+') ';
        }
        $("#productsubname").val(productname);
    }else{
        alert("Please enter product name first");
    }
});
</script>
</body>
</html>
